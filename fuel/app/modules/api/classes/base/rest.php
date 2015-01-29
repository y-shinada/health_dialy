<?php

namespace Api;

abstract class Controller_Base_Rest extends \Fuel\Core\Controller_Rest
{
	public function before()
	{
		parent::before();
	}

	public function after($response)
	{
		return parent::after($response);
	}

	/**
	 * Router
	 *
	 * Requests are not made to methods directly The request will be for an "object".
	 * this simply maps the object and method to the correct Controller method.
	 *
	 * @param  string
	 * @param  array
	 */
	public function router($resource, $arguments)
	{
		parent::router($resource, $arguments);
	}

	/**
	 * Response
	 *
	 * Takes pure data and optionally a status code, then creates the response
	 *
	 * @param   mixed
	 * @param   int
	 * @return  object  Response instance
	 */
	protected function response($data = array(), $http_status = null)
	{
		return parent::response($data, $http_status);
	}

	/**
	 * Set the Response http status.
	 *
	 * @param   integer  $status  response http status code
	 * @return  void
	 */
	protected function http_status($status)
	{
		$this->http_status = $status;
	}

	/**
	 * Detect format
	 *
	 * Detect which format should be used to output the data
	 *
	 * @return  string
	 */
	protected function _detect_format()
	{
		// A format has been passed as a named parameter in the route
		if ($this->param('format') and array_key_exists($this->param('format'), $this->_supported_formats))
		{
			return $this->param('format');
		}

		// A format has been passed as an argument in the URL and it is supported
		if (\Input::param('format') and array_key_exists(\Input::param('format'), $this->_supported_formats))
		{
			return \Input::param('format');
		}

		// Otherwise, check the HTTP_ACCEPT (if it exists and we are allowed)
		if ($acceptable = \Input::server('HTTP_ACCEPT') and \Config::get('rest.ignore_http_accept') !== true)
		{
			// If anything is accepted, and we have a default, return that
			if ($acceptable == '*/*' and ! empty($this->rest_format))
			{
				return $this->rest_format;
			}

			// Split the Accept header and build an array of quality scores for each format
			$fragments = new \CachingIterator(new \ArrayIterator(preg_split('/[,;]/', \Input::server('HTTP_ACCEPT'))));
			$acceptable = array();
			$next_is_quality = false;
			foreach ($fragments as $fragment)
			{
				$quality = 1;
				// Skip the fragment if it is a quality score
				if ($next_is_quality)
				{
					$next_is_quality = false;
					continue;
				}

				// If next fragment exists and is a quality score, set the quality score
				elseif ($fragments->hasNext())
				{
					$next = $fragments->getInnerIterator()->current();
					if (strpos($next, 'q=') === 0)
					{
						list($key, $quality) = explode('=', $next);
						$next_is_quality = true;
					}
				}

				$acceptable[$fragment] = $quality;
			}

			// Sort the formats by score in descending order
			uasort($acceptable, function($a, $b)
			{
				$a = (float) $a;
				$b = (float) $b;
				return ($a > $b) ? -1 : 1;
			});

			// Check each of the acceptable formats against the supported formats
			foreach ($acceptable as $pattern => $quality)
			{
				// The Accept header can contain wildcards in the format
				$find = array('*', '/');
				$replace = array('.*', '\/');
				$pattern = '/^' . str_replace($find, $replace, $pattern) . '$/';
				foreach ($this->_supported_formats as $format => $mime)
				{
					if (preg_match($pattern, $mime))
					{
						return $format;
					}
				}
			}
		} // End HTTP_ACCEPT checking

		// Well, none of that has worked! Let's see if the controller has a default
		if ( ! empty($this->rest_format))
		{
			return $this->rest_format;
		}

		// Just use the default format
		return \Config::get('rest.default_format');
	}

	/**
	 * Detect language(s)
	 *
	 * What language do they want it in?
	 *
	 * @return  null|array|string
	 */
	protected function _detect_lang()
	{
		if (!$lang = \Input::server('HTTP_ACCEPT_LANGUAGE'))
		{
			return null;
		}

		// They might have sent a few, make it an array
		if (strpos($lang, ',') !== false)
		{
			$langs = explode(',', $lang);

			$return_langs = array();

			foreach ($langs as $lang)
			{
				// Remove weight and strip space
				list($lang) = explode(';', $lang);
				$return_langs[] = trim($lang);
			}

			return $return_langs;
		}

		// Nope, just return the string
		return $lang;
	}

	// SECURITY FUNCTIONS ---------------------------------------------------------

	protected function _check_login($username = '', $password = null)
	{
		if (empty($username))
		{
			return false;
		}

		$valid_logins = \Config::get('rest.valid_logins');

		if (!array_key_exists($username, $valid_logins))
		{
			return false;
		}

		// If actually null (not empty string) then do not check it
		if ($password !== null and $valid_logins[$username] != $password)
		{
			return false;
		}

		return true;
	}

	protected function _prepare_basic_auth()
	{
		$username = null;
		$password = null;

		// mod_php
		if (\Input::server('PHP_AUTH_USER'))
		{
			$username = \Input::server('PHP_AUTH_USER');
			$password = \Input::server('PHP_AUTH_PW');
		}

		// most other servers
		elseif (\Input::server('HTTP_AUTHENTICATION'))
		{
			if (strpos(strtolower(\Input::server('HTTP_AUTHENTICATION')), 'basic') === 0)
			{
				list($username, $password) = explode(':', base64_decode(substr(\Input::server('HTTP_AUTHORIZATION'), 6)));
			}
		}

		if ( ! static::_check_login($username, $password))
		{
			static::_force_login();
			return false;
		}

		return true;
	}

	protected function _prepare_digest_auth()
	{
		// Empty argument for backward compatibility
		$uniqid = uniqid("");

		// We need to test which server authentication variable to use
		// because the PHP ISAPI module in IIS acts different from CGI
		if (\Input::server('PHP_AUTH_DIGEST'))
		{
			$digest_string = \Input::server('PHP_AUTH_DIGEST');
		}
		elseif (\Input::server('HTTP_AUTHORIZATION'))
		{
			$digest_string = \Input::server('HTTP_AUTHORIZATION');
		}
		else
		{
			$digest_string = '';
		}

		// Prompt for authentication if we don't have a digest string
		if (empty($digest_string))
		{
			static::_force_login($uniqid);
			return false;
		}

		// We need to retrieve authentication informations from the $digest_string variable
		$digest_params = explode(', ', $digest_string);
		foreach ($digest_params as $digest_param)
		{
			$digest_param = explode('=', $digest_param, 2);
			if (isset($digest_param[1]))
			{
				$digest[$digest_param[0]] = trim($digest_param[1], '"');
			}
		}

		// if no username, or an invalid username found, re-authenticate
		if ( ! array_key_exists('username', $digest) or ! static::_check_login($digest['username']))
		{
			static::_force_login($uniqid);
			return false;
		}

		// validate the configured login/password
		$valid_logins = \Config::get('rest.valid_logins');
		$valid_pass = $valid_logins[$digest['username']];

		// This is the valid response expected
		$A1 = md5($digest['username'] . ':' . \Config::get('rest.realm') . ':' . $valid_pass);
		$A2 = md5(strtoupper(\Input::method()) . ':' . $digest['uri']);
		$valid_response = md5($A1 . ':' . $digest['nonce'] . ':' . $digest['nc'] . ':' . $digest['cnonce'] . ':' . $digest['qop'] . ':' . $A2);

		if ($digest['response'] != $valid_response)
		{
			return false;
		}

		return true;
	}

	protected function _force_login($nonce = '')
	{
		// Get the configured auth method if none is defined
		$this->auth === null and $this->auth = \Config::get('rest.auth');

		if ($this->auth == 'basic')
		{
			$this->response->set_header('WWW-Authenticate', 'Basic realm="'. \Config::get('rest.realm') . '"');
		}
		elseif ($this->auth == 'digest')
		{
			$this->response->set_header('WWW-Authenticate', 'Digest realm="' . \Config::get('rest.realm') . '", qop="auth", nonce="' . $nonce . '", opaque="' . md5(\Config::get('rest.realm')) . '"');
		}
	}

}

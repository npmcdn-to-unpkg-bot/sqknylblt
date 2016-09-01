7.x common.inc	:

drupal_http_request($url, array $options = array())

    Performs an HTTP request.

    This is a flexible and powerful HTTP client implementation. Correctly handles GET, POST, PUT or any other HTTP requests. Handles redirects.

    Parameters

    $url: A string containing a fully qualified URI.

    array $options: (optional) An array that can have one or more of the following elements:

        headers: An array containing request headers to send as name/value pairs.
        method: A string containing the request method. Defaults to 'GET'.
        data: A string containing the request body, formatted as 'param=value&param=value&...'. Defaults to NULL.
        max_redirects: An integer representing how many times a redirect may be followed. Defaults to 3.
        timeout: A float representing the maximum number of seconds the function call may take. The default is 30 seconds. If a timeout occurs, the error code is set to the HTTP_REQUEST_TIMEOUT constant.
        context: A context resource created with stream_context_create().


    Return value

    object An object that can have one or more of the following components:

        request: A string containing the request body that was sent.
        code: An integer containing the response status code, or the error code if an error occurred.
        protocol: The response protocol (e.g. HTTP/1.1 or HTTP/1.0).
        status_message: The status message from the response, if a response was received.
        redirect_code: If redirected, an integer containing the initial response status code.
        redirect_url: If redirected, a string containing the URL of the redirect target.
        error: If an error occurred, the error message. Otherwise not set.
        headers: An array containing the response headers as name/value pairs. HTTP header names are case-insensitive (RFC 2616, section 4.2), so for easy access the array keys are returned in lower case.
        data: A string containing the response body that was received.


Note:
 $responses = array(
    100 => 'Continue',
    101 => 'Switching Protocols',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    307 => 'Temporary Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Time-out',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Large',
    415 => 'Unsupported Media Type',
    416 => 'Requested range not satisfiable',
    417 => 'Expectation Failed',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Time-out',
    505 => 'HTTP Version not supported',
  );
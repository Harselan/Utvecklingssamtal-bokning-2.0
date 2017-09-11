<?php
/*
För att fixa routessystemet behöver du skriva in följande kod
i config filen för apache om du inte redan har gjort det.

<Directory />
    Options Indexes FollowSymLinks
    AllowOverride All
</Directory>

Sedan måste du även ha en fil i mappen på projektet som kallas .htaccess.
I denna fil kan du skriva in
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On

    # Redirect Trailing Slashes...
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
och efter det så borde routessystemet att fungera.
Felsök annars.
*/
class Route
{
    private static $posts = [];
    private static $gets = [];

    public static function get($path, $function)
    {
        self::$gets[$path] = $function;
    }

    public static function post($path, $function)
    {
        self::$posts[$path] = $function;
    }

    public static function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if(strlen($path) > 1)
        {
            $path = rtrim($path, "/");
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $array = self::$posts;
        }
        else
        {
            $array = self::$gets;
        }

        if(isset($array[$path]))
        {
            $function_array = explode("@", $array[$path]);

            $controller_string = $function_array[0];

            $method_string = $function_array[1];

            $args = [];

            if(class_exists($controller_string))
            {
                $controller_obj = new $controller_string();

                if(method_exists($controller_obj, $method_string))
                {
                    call_user_func_array([$controller_obj, $method_string], $args);
                    return true;
                }
            }
        }

        foreach($array as $key => $element)
        {
            $args_count = preg_match_all(";{.*};", $key, $matches2);
            $pattern = ";^" . preg_replace("/{[A-Za-z0-9]+}/","([A-Za-z0-9%]+)", $key) . "$;";
            preg_match_all($pattern, $path, $matches);

            if(!empty($matches[0]))
            {
                $function = $element;

                $arg_array = array_slice($matches, 1);
                $args = [];
                foreach($arg_array as $arg)
                {
                    $args[] = $arg[0];
                }
            }

        }

        if(!empty($function))
        {
            # $function looks like: 'ExampleController@method', this will sort it into an array that will look like this: ['ExampleController', 'method']
            $function_array = explode("@", $function);

            # This is the controller part of the array from before
            $controller_string = $function_array[0];

            # This is the method part of the array from before
            $method_string = $function_array[1];

            # Create an instance of the controller and run the method

            if(class_exists($controller_string))
            {
                $controller_obj = new $controller_string();

                if(method_exists($controller_obj, $method_string))
                {
                    call_user_func_array([$controller_obj, $method_string], $args);
                    return true;
                }
            }
        }
        redirect('/');
    }
}
?>

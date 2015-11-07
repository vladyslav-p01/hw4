<?php

namespace Twig;

Class TwigAccess
{

    private static $loader;

    private static $twig;

    public static function twigRender($template, $variables = array())
    {
        self::$loader = new \Twig_Loader_Filesystem('../src/Views/templates/');
        self::$twig = new \Twig_Environment(self::$loader);
        return self::$twig->render($template, $variables);
    }

}




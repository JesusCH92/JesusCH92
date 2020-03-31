<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* contacts/index.twig */
class __TwigTemplate_1e63cdd0c8b09b26675d26bb2de3702c5dec40e7d0738496c68c9c293aba16d8 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.twig", "contacts/index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    <div class=\"row\">
        <div class=\"col\">
            <h1>Contact me!</h1>
            <form action=\"/primer-proyecto-php/contact/send\" method=\"POST\">
                <label for=\"\">Name: </label>
                <input type=\"text\" name=\"name\"><br>
                <label for=\"\">Email: </label>
                <input type=\"text\" name=\"email\"><br>
                <label for=\"\">Message: </label>
                <input type=\"text\" name=\"message\"><br>
                <button type=\"submit\">Save</button>
            </form>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "contacts/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout.twig\" %}

{% block content %}
    <div class=\"row\">
        <div class=\"col\">
            <h1>Contact me!</h1>
            <form action=\"/primer-proyecto-php/contact/send\" method=\"POST\">
                <label for=\"\">Name: </label>
                <input type=\"text\" name=\"name\"><br>
                <label for=\"\">Email: </label>
                <input type=\"text\" name=\"email\"><br>
                <label for=\"\">Message: </label>
                <input type=\"text\" name=\"message\"><br>
                <button type=\"submit\">Save</button>
            </form>
        </div>
    </div>
{% endblock %}", "contacts/index.twig", "C:\\xampp\\htdocs\\primer-proyecto-php\\views\\contacts\\index.twig");
    }
}

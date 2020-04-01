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

/* changePassword.twig */
class __TwigTemplate_819ddbc5968571ba7f722a582379549ce7a574d31f48caf29ab41313a2a82538 extends Template
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
        $this->parent = $this->loadTemplate("layout.twig", "changePassword.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    <h1>Write your new password!</h1>
    <div class=\"alert alert-primary\" role=\"alert\"> 
            ";
        // line 6
        echo twig_escape_filter($this->env, ($context["responseMessage"] ?? null), "html", null, true);
        echo "
    </div>
        <form action=\"/primer-proyecto-php/resetPassword\" method=\"POST\">
            <label for=\"\">New password: </label>
            <input type=\"password\" name=\"password\"><br>
            <button type=\"submit\">Save</button>
        </form>
";
    }

    public function getTemplateName()
    {
        return "changePassword.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 6,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'layout.twig' %}

{% block content%}
    <h1>Write your new password!</h1>
    <div class=\"alert alert-primary\" role=\"alert\"> 
            {{ responseMessage }}
    </div>
        <form action=\"/primer-proyecto-php/resetPassword\" method=\"POST\">
            <label for=\"\">New password: </label>
            <input type=\"password\" name=\"password\"><br>
            <button type=\"submit\">Save</button>
        </form>
{% endblock %}", "changePassword.twig", "C:\\xampp\\htdocs\\primer-proyecto-php\\views\\changePassword.twig");
    }
}

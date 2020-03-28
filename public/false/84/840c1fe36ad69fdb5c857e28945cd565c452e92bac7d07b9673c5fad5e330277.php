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

/* addUser.twig */
class __TwigTemplate_6229d699fe98d24f31afa829b198f144825a967984b7c6ddb88e58371d921ce6 extends Template
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
        $this->parent = $this->loadTemplate("layout.twig", "addUser.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    <h1>Add User</h1>
    <div class=\"alert alert-primary\" role=\"alert\">
      ";
        // line 6
        echo twig_escape_filter($this->env, ($context["responseMessage"] ?? null), "html", null, true);
        echo "
    </div>

    <form action=\"/primer-proyecto-php/users/save\" method=\"post\" >
        <label for=\"\">Email:</label>
        <input type=\"text\" name=\"email\" ><br>
        <label for=\"\">Password:</label>
        <input type=\"password\" name=\"password\"><br>
        <button type=\"submit\">Save</button>
    </form>
";
    }

    public function getTemplateName()
    {
        return "addUser.twig";
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
        return new Source("{% extends \"layout.twig\" %}

{% block content %}
    <h1>Add User</h1>
    <div class=\"alert alert-primary\" role=\"alert\">
      {{ responseMessage }}
    </div>

    <form action=\"/primer-proyecto-php/users/save\" method=\"post\" >
        <label for=\"\">Email:</label>
        <input type=\"text\" name=\"email\" ><br>
        <label for=\"\">Password:</label>
        <input type=\"password\" name=\"password\"><br>
        <button type=\"submit\">Save</button>
    </form>
{% endblock %}", "addUser.twig", "C:\\xampp\\htdocs\\primer-proyecto-php\\views\\addUser.twig");
    }
}

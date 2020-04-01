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

/* admin.twig */
class __TwigTemplate_837722e269318e31753f7d91cac320f7f1fc844af636881ff205fe943fa2ae0f extends Template
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
        $this->parent = $this->loadTemplate("layout.twig", "admin.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "<h1>Dashborad</h1>
<ul>
    <li><a href=\"/primer-proyecto-php/users/add\">Add users</a></li>
    <li><a href=\"/primer-proyecto-php/jobs/add\">Add Jobs</a></li>
    <li><a href=\"/primer-proyecto-php/changePassword\">Change your password</a></li>
</ul>
<a href=\"/primer-proyecto-php/logout\">Logout</a>
";
    }

    public function getTemplateName()
    {
        return "admin.twig";
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
<h1>Dashborad</h1>
<ul>
    <li><a href=\"/primer-proyecto-php/users/add\">Add users</a></li>
    <li><a href=\"/primer-proyecto-php/jobs/add\">Add Jobs</a></li>
    <li><a href=\"/primer-proyecto-php/changePassword\">Change your password</a></li>
</ul>
<a href=\"/primer-proyecto-php/logout\">Logout</a>
{% endblock %}", "admin.twig", "C:\\xampp\\htdocs\\primer-proyecto-php\\views\\admin.twig");
    }
}

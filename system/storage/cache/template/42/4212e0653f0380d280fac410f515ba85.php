<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* install/view/template/install/step_4.twig */
class __TwigTemplate_7f15058df7a3803681dbc7f90e35ba00 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield ($context["header"] ?? null);
        yield "
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container\">
\t\t\t<h1>";
        // line 5
        yield ($context["heading_title"] ?? null);
        yield "</h1>
\t\t</div>
\t</div>
\t<div class=\"container\">
\t\t<div class=\"alert alert-danger\"><i class=\"fa-solid fa-circle-exclamation\"></i> ";
        // line 9
        yield ($context["error_warning"] ?? null);
        yield "</div>
\t\t<div class=\"card\">
\t\t\t<div class=\"card-header\"><i class=\"fa-solid fa-pencil\"></i> ";
        // line 11
        yield ($context["text_step_4"] ?? null);
        yield "</div>
\t\t\t<div class=\"card-body p-4\">
\t\t\t\t<div class=\"row mb-4\">
\t\t\t\t\t<div class=\"col-6 text-center\">
\t\t\t\t\t\t<a href=\"../\"><img src=\"view/image/catalog.jpg\" alt=\"OpenCart\" title=\"OpenCart\" class=\"img-thumbnail\"/></a>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<a href=\"../\" class=\"btn btn-outline-secondary mt-3\">";
        // line 17
        yield ($context["text_catalog"] ?? null);
        yield "</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-6 text-center\">
\t\t\t\t\t\t<a href=\"../admin/\" class=\"mb-3\"><img src=\"view/image/admin.jpg\" alt=\"OpenCart\" title=\"OpenCart\" class=\"img-thumbnail\"/></a>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<a href=\"../admin/\" class=\"btn btn-outline-secondary mt-3\">";
        // line 22
        yield ($context["text_admin"] ?? null);
        yield "</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"mb-4\">";
        // line 25
        yield ($context["promotion"] ?? null);
        yield "</div>
\t\t\t\t<div class=\"m-4 text-center\">
          <a href=\"https://www.opencart.com/index.php?route=marketplace/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"btn btn-outline-secondary\">";
        // line 27
        yield ($context["text_extension"] ?? null);
        yield "</a>
        </div>
\t\t\t\t<fieldset class=\"mb-5\">
\t\t\t\t\t<legend><i class=\"fa-solid fa-envelope\"></i> ";
        // line 30
        yield ($context["text_mail"] ?? null);
        yield "</legend>
\t\t\t\t\t<div class=\"text-center\">
\t\t\t\t\t\t<p class=\"pb-2\">";
        // line 32
        yield ($context["text_mail_description"] ?? null);
        yield "</p>
\t\t\t\t\t\t<a href=\"http://newsletter.opencart.com/h/r/B660EBBE4980C85C\" target=\"_blank\" class=\"btn btn-primary\"><i class=\"fa-solid fa-envelope\"></i> ";
        // line 33
        yield ($context["button_mail"] ?? null);
        yield "</a>
\t\t\t\t\t</div>
\t\t\t\t</fieldset>
\t\t\t\t<div class=\"row mb-4\">
\t\t\t\t\t<div class=\"col-4 text-center\">
\t\t\t\t\t\t<h3><a href=\"https://www.facebook.com/opencart/\" target=\"_blank\" class=\"icon transition\"><i class=\"fab fa-facebook\"></i></a> ";
        // line 38
        yield ($context["text_facebook"] ?? null);
        yield "</h3>
\t\t\t\t\t\t<p>";
        // line 39
        yield ($context["text_facebook_description"] ?? null);
        yield "</p>
\t\t\t\t\t\t<a href=\"https://www.facebook.com/opencart/\" target=\"_blank\">";
        // line 40
        yield ($context["text_facebook_visit"] ?? null);
        yield "</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-4 text-center\">
\t\t\t\t\t\t<h3><a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"icon transition\"><i class=\"fa-solid fa-comments\"></i></a> ";
        // line 43
        yield ($context["text_forum"] ?? null);
        yield "</h3>
\t\t\t\t\t\t<p>";
        // line 44
        yield ($context["text_forum_description"] ?? null);
        yield "</p>
\t\t\t\t\t\t<a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" target=\"_blank\">";
        // line 45
        yield ($context["text_forum_visit"] ?? null);
        yield "</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-4 text-center\">
\t\t\t\t\t\t<h3><a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"icon transition\"><i class=\"fa-solid fa-user\"></i></a> ";
        // line 48
        yield ($context["text_commercial"] ?? null);
        yield "</h3>
\t\t\t\t\t\t<p>";
        // line 49
        yield ($context["text_commercial_description"] ?? null);
        yield "</p>
\t\t\t\t\t\t<a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_blank\">";
        // line 50
        yield ($context["text_commercial_visit"] ?? null);
        yield "</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
        // line 57
        yield ($context["footer"] ?? null);
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "install/view/template/install/step_4.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  158 => 57,  148 => 50,  144 => 49,  140 => 48,  134 => 45,  130 => 44,  126 => 43,  120 => 40,  116 => 39,  112 => 38,  104 => 33,  100 => 32,  95 => 30,  89 => 27,  84 => 25,  78 => 22,  70 => 17,  61 => 11,  56 => 9,  49 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{{ header }}
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container\">
\t\t\t<h1>{{ heading_title }}</h1>
\t\t</div>
\t</div>
\t<div class=\"container\">
\t\t<div class=\"alert alert-danger\"><i class=\"fa-solid fa-circle-exclamation\"></i> {{ error_warning }}</div>
\t\t<div class=\"card\">
\t\t\t<div class=\"card-header\"><i class=\"fa-solid fa-pencil\"></i> {{ text_step_4 }}</div>
\t\t\t<div class=\"card-body p-4\">
\t\t\t\t<div class=\"row mb-4\">
\t\t\t\t\t<div class=\"col-6 text-center\">
\t\t\t\t\t\t<a href=\"../\"><img src=\"view/image/catalog.jpg\" alt=\"OpenCart\" title=\"OpenCart\" class=\"img-thumbnail\"/></a>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<a href=\"../\" class=\"btn btn-outline-secondary mt-3\">{{ text_catalog }}</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-6 text-center\">
\t\t\t\t\t\t<a href=\"../admin/\" class=\"mb-3\"><img src=\"view/image/admin.jpg\" alt=\"OpenCart\" title=\"OpenCart\" class=\"img-thumbnail\"/></a>
\t\t\t\t\t\t<br/>
\t\t\t\t\t\t<a href=\"../admin/\" class=\"btn btn-outline-secondary mt-3\">{{ text_admin }}</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"mb-4\">{{ promotion }}</div>
\t\t\t\t<div class=\"m-4 text-center\">
          <a href=\"https://www.opencart.com/index.php?route=marketplace/extension&utm_source=opencart_install&utm_medium=store_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"btn btn-outline-secondary\">{{ text_extension }}</a>
        </div>
\t\t\t\t<fieldset class=\"mb-5\">
\t\t\t\t\t<legend><i class=\"fa-solid fa-envelope\"></i> {{ text_mail }}</legend>
\t\t\t\t\t<div class=\"text-center\">
\t\t\t\t\t\t<p class=\"pb-2\">{{ text_mail_description }}</p>
\t\t\t\t\t\t<a href=\"http://newsletter.opencart.com/h/r/B660EBBE4980C85C\" target=\"_blank\" class=\"btn btn-primary\"><i class=\"fa-solid fa-envelope\"></i> {{ button_mail }}</a>
\t\t\t\t\t</div>
\t\t\t\t</fieldset>
\t\t\t\t<div class=\"row mb-4\">
\t\t\t\t\t<div class=\"col-4 text-center\">
\t\t\t\t\t\t<h3><a href=\"https://www.facebook.com/opencart/\" target=\"_blank\" class=\"icon transition\"><i class=\"fab fa-facebook\"></i></a> {{ text_facebook }}</h3>
\t\t\t\t\t\t<p>{{ text_facebook_description }}</p>
\t\t\t\t\t\t<a href=\"https://www.facebook.com/opencart/\" target=\"_blank\">{{ text_facebook_visit }}</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-4 text-center\">
\t\t\t\t\t\t<h3><a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"icon transition\"><i class=\"fa-solid fa-comments\"></i></a> {{ text_forum }}</h3>
\t\t\t\t\t\t<p>{{ text_forum_description }}</p>
\t\t\t\t\t\t<a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=forum_link&utm_campaign=opencart_install\" target=\"_blank\">{{ text_forum_visit }}</a>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-4 text-center\">
\t\t\t\t\t\t<h3><a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_blank\" class=\"icon transition\"><i class=\"fa-solid fa-user\"></i></a> {{ text_commercial }}</h3>
\t\t\t\t\t\t<p>{{ text_commercial_description }}</p>
\t\t\t\t\t\t<a href=\"https://www.opencart.com/index.php?route=support/partner&utm_source=opencart_install&utm_medium=partner_link&utm_campaign=opencart_install\" target=\"_blank\">{{ text_commercial_visit }}</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
{{ footer }}
", "install/view/template/install/step_4.twig", "C:\\laragon\\www\\candyfandy\\install\\view\\template\\install\\step_4.twig");
    }
}

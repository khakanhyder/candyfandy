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

/* install/view/template/common/footer.twig */
class __TwigTemplate_423c2698bc620ffb011ee341eca0b718 extends Template
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
        yield "<footer class=\"pb-4\">
  <div class=\"container text-center\">
    <a href=\"https://www.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">";
        // line 3
        yield ($context["text_project"] ?? null);
        yield "</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://docs.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">";
        yield ($context["text_documentation"] ?? null);
        yield "</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">";
        yield ($context["text_support"] ?? null);
        yield "</a>
    <br/>
    ";
        // line 5
        yield ($context["text_footer"] ?? null);
        yield "
  </div>
</footer>
</div>
</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "install/view/template/common/footer.twig";
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
        return array (  55 => 5,  46 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<footer class=\"pb-4\">
  <div class=\"container text-center\">
    <a href=\"https://www.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">{{ text_project }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://docs.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">{{ text_documentation }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://forum.opencart.com/?utm_source=opencart_install&utm_medium=footer_link&utm_campaign=opencart_install\" target=\"_blank\">{{ text_support }}</a>
    <br/>
    {{ text_footer }}
  </div>
</footer>
</div>
</body>
</html>
", "install/view/template/common/footer.twig", "C:\\laragon\\www\\candyfandy\\install\\view\\template\\common\\footer.twig");
    }
}

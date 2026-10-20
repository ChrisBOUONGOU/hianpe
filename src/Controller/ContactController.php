<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


final class ContactController
{
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function __invoke(Request $request,
    EntityManagerInterface $entityManager,
    MailerInterface $mailer): Response
    {

    if ($request->isMethod('POST')) {
        $name = trim((string) $request->request->get('name', ''));
        $email = trim((string) $request->request->get('email', ''));
        $subject = trim((string) $request->request->get('subject', ''));
        $message = trim((string) $request->request->get('message', ''));
        $language = $request->request->get('language', 'fr') === 'en' ? 'en' : 'fr';

        if (
            $name === '' || strlen($name) > 150 ||
            !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 180 ||
            $subject === '' || strlen($subject) > 255 ||
            strlen($message) < 10 || strlen($message) > 5000
        ) {
            return new Response(
                'Formulaire invalide. Vérifiez les champs et réessayez.',
                Response::HTTP_BAD_REQUEST
            );
        }

        $contactMessage = new ContactMessage();
        $contactMessage->setName($name);
        $contactMessage->setEmail($email);
        $contactMessage->setSubject($subject);
        $contactMessage->setMessage($message);
        $contactMessage->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($contactMessage);
        $entityManager->flush();

        try {
    $notification = (new Email())
        ->from('contact@www.hianpe.com')
        ->to('chrisbouk@outlook.fr')
        ->replyTo($email)
        ->subject(($language === 'en' ? '[Hianpe] New request: ' : '[Hianpe] Nouvelle demande : ') . $subject)
        ->text(
            $language === 'en'
                ? "New request received from the Hianpe website.\n\n"
                    . "Name: " . $name . "\n"
                    . "Email address: " . $email . "\n"
                    . "Subject: " . $subject . "\n\n"
                    . "Message:\n" . $message
                : "Nouvelle demande reçue depuis le site Hianpe.\n\n"
                    . "Nom : " . $name . "\n"
                    . "Adresse e-mail : " . $email . "\n"
                    . "Sujet : " . $subject . "\n\n"
                    . "Message :\n" . $message
        );

    $mailer->send($notification);

    return new RedirectResponse('/contact?sent=1');

} catch (TransportExceptionInterface $exception) {
    // La demande reste sauvegardée même si l'envoi échoue.
    return new RedirectResponse('/contact?sent=1&mail_error=1');
}

       
    }
        return new Response(<<<'HTML'
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Contactez Hianpe pour votre projet de développement logiciel C#/.NET, application web ou assistance technique.">
<meta name="theme-color" content="#171714"><title>Contact — Hianpe</title>
<style>
:root{--ink:#171714;--paper:#f5f0e6;--yellow:#f5c542;--muted:#6f6b62;--line:rgba(23,23,20,.14);--white:#fffdf8;--max:1120px}*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,system-ui,-apple-system,"Segoe UI",sans-serif;line-height:1.6}a{color:inherit;text-decoration:none}.wrap{width:min(var(--max),calc(100% - 40px));margin:auto}.topbar{position:sticky;top:0;background:rgba(245,240,230,.94);backdrop-filter:blur(12px);border-bottom:1px solid var(--line)}.nav{height:78px;display:flex;align-items:center;justify-content:space-between;gap:20px}.brand{display:flex;align-items:center;gap:11px;font-weight:900;font-size:1.35rem;letter-spacing:-.04em}.brand img{width:44px;height:44px;object-fit:contain;border-radius:10px}.navlinks{display:flex;align-items:center;gap:24px;font-weight:700;font-size:.92rem}.navlinks a:hover,.footer a:hover{opacity:.7}.button{display:inline-flex;align-items:center;justify-content:center;gap:9px;background:var(--ink);color:var(--white);border:1px solid var(--ink);border-radius:999px;padding:13px 19px;font-weight:800;font-size:.92rem;cursor:pointer;transition:transform .2s}.button:hover{transform:translateY(-2px)}.button.yellow{background:var(--yellow);border-color:var(--yellow);color:var(--ink)}.button.outline{background:transparent;color:var(--ink)}.language-toggle{border:1px solid var(--line);background:transparent;color:var(--ink);border-radius:999px;padding:10px 13px;font:inherit;font-size:.82rem;font-weight:850;cursor:pointer;white-space:nowrap}.language-toggle:hover{background:var(--yellow);border-color:var(--yellow)}.hero{padding:74px 0 42px}.eyebrow{display:inline-flex;align-items:center;gap:9px;text-transform:uppercase;letter-spacing:.14em;font-size:.74rem;font-weight:900;color:#6b5a22}.eyebrow:before{content:"";width:25px;height:2px;background:var(--yellow)}h1,h2,h3,p{margin-top:0}h1{font-size:clamp(3rem,7vw,5.4rem);letter-spacing:-.075em;line-height:.98;margin:20px 0}.hero h1 span{background:var(--yellow);padding:0 .1em}.hero p{font-size:1.1rem;color:var(--muted);max-width:680px;margin:0}.layout{display:grid;grid-template-columns:.8fr 1.2fr;gap:26px;padding:18px 0 86px;align-items:start}.info{background:var(--ink);color:var(--white);padding:30px;border-radius:24px}.info h2{font-size:1.75rem;letter-spacing:-.045em;margin:14px 0}.info>p{color:#c4c1b6;font-size:.94rem}.info-item{border-top:1px solid #41413a;padding:19px 0}.info-label{color:#b6b3a7;font-size:.75rem;text-transform:uppercase;letter-spacing:.12em;font-weight:800;margin-bottom:7px}.info-item a{color:var(--yellow);font-weight:750;overflow-wrap:anywhere}.info-item p{margin:0;color:#f4f0e6;font-size:.94rem}.back{display:inline-block;margin-top:12px;font-weight:800;font-size:.9rem}.form-card{background:var(--white);border:1px solid var(--line);border-radius:24px;padding:clamp(22px,4vw,38px)}.form-card h2{font-size:1.85rem;letter-spacing:-.05em;margin-bottom:8px}.form-intro{color:var(--muted);font-size:.94rem;margin-bottom:25px}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.field{display:flex;flex-direction:column;gap:7px}.field.full{grid-column:1/-1}label{font-size:.86rem;font-weight:800}input,select,textarea{font:inherit;color:var(--ink);width:100%;border:1px solid #d8d1c4;border-radius:12px;background:#fffefa;padding:13px 14px;outline:none}input:focus,select:focus,textarea:focus{border-color:#b38a0c;box-shadow:0 0 0 3px #f5c54245}textarea{min-height:150px;resize:vertical}.hint,.notice{font-size:.8rem;color:var(--muted)}.form-actions{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-top:22px}.notice{margin:17px 0 0}.footer{background:var(--ink);color:#b9b6ab;padding:25px 0;font-size:.83rem}.footer-inner{display:flex;justify-content:space-between;gap:20px;align-items:center}@media(max-width:760px){.hero{padding:54px 0 30px}.layout{grid-template-columns:1fr;padding-bottom:58px}.navlinks{gap:13px}.info{order:2}.form-card{order:1}}@media(max-width:520px){.wrap{width:calc(100% - 28px)}.nav{height:70px}.brand img{width:39px;height:39px}.navlinks>a:not(.button){display:none}.navlinks .button{font-size:.82rem;padding:10px 13px}.hero{padding-top:44px}h1{font-size:clamp(2.8rem,14vw,4rem)}.form-grid{grid-template-columns:1fr}.field.full{grid-column:auto}.footer-inner{align-items:flex-start;flex-direction:column}}@media(prefers-reduced-motion:reduce){*,*:before,*:after{transition:none!important}}
</style>
</head>
<body>
<header class="topbar"><div class="wrap nav"><a class="brand" href="/" aria-label="Hianpe, accueil"><img src="/assets/logo_hianpe.png" alt="Logo Hianpe">Hianpe</a><nav class="navlinks" aria-label="Navigation principale"><a href="/#services">Services</a><a href="/#logiciels">Logiciels</a><button class="language-toggle" type="button" aria-label="Switch to English" title="Switch to English">EN</button><a class="button" href="/">Accueil ↗</a></nav></div></header>
<main>
<section class="hero"><div class="wrap"><div class="eyebrow">Contact Hianpe</div><h1>Parlons de votre <span>projet.</span></h1><p>Une idée d'application, un logiciel à améliorer ou un besoin à automatiser ? Décrivez-nous votre objectif. Même si votre projet n'est pas encore entièrement défini, nous pouvons commencer par en discuter.</p></div></section>
<section class="wrap layout">
<aside class="info"><div class="eyebrow">Restons en contact</div><h2>Un premier échange, simplement.</h2><p>Quelques informations sur votre besoin nous aideront à mieux comprendre votre projet.</p>
<div class="info-item"><div class="info-label">Adresse e-mail</div><a href="mailto:chrisbouk@outlook.fr">chrisbouk@outlook.fr ↗</a></div>
<div class="info-item"><div class="info-label">Domaines</div><p>Développement C# / .NET, applications de bureau, solutions web, maintenance et automatisation.</p></div>
<div class="info-item"><div class="info-label">Pour gagner du temps</div><p>Précisez le résultat attendu, les fonctionnalités prioritaires et, si vous en avez une, votre échéance.</p></div><a class="back" href="/">← Retour à l'accueil</a>
</aside>
<section class="form-card" aria-labelledby="form-title"><h2 id="form-title">Présentez votre besoin</h2><p class="form-intro">Remplissez les champs ci-dessous. Votre application de messagerie s'ouvrira avec le message préparé, prêt à être envoyé.</p>
<form id="contact-form" action="/contact" method="post"><input type="hidden" name="language" id="language-field" value="fr"><div class="form-grid">
<div class="field"><label for="name">Votre nom *</label><input id="name" name="name" autocomplete="name" required maxlength="100" placeholder="Nom et prénom"></div>
<div class="field"><label for="email">Votre adresse e-mail *</label><input id="email" name="email" type="email" autocomplete="email" required maxlength="160" placeholder="vous@exemple.com"></div>
<div class="field full"><label for="subject">Sujet de votre demande *</label><select id="subject" name="subject" required><option value="">Choisissez un sujet</option><option>Développement C# / .NET</option><option>Logiciel ou application sur mesure</option><option>Site web / application web</option><option>Maintenance ou correction</option><option>Automatisation</option><option>StageFlow</option><option>Autre demande</option></select></div>
<div class="field full"><label for="message">Votre message *</label><textarea id="message" name="message" required minlength="10" maxlength="5000" placeholder="Décrivez votre projet, le problème à résoudre et les fonctionnalités souhaitées…"></textarea><span class="hint">Évitez d'inclure des mots de passe ou des informations confidentielles.</span></div>
</div><div class="form-actions"><button class="button yellow" type="submit">Envoyer ma demande ↗</button></div><p class="notice" id="form-status">
    Votre demande sera enregistrée après validation du formulaire.
</p></form>
</section></section>
</main>
<footer class="footer"><div class="wrap footer-inner"><span>© <span id="year">2026</span> Hianpe. Des solutions numériques pensées pour durer.</span><a href="/">Retour à l'accueil ↗</a></div></footer>
<script>
document.getElementById('year').textContent=new Date().getFullYear();
const params = new URLSearchParams(window.location.search);
const status = document.getElementById('form-status');

if (params.get('mail_error') === '1') {
    status.textContent =
        'Votre demande est enregistrée, mais l’e-mail n’a pas pu être envoyé.';

} else if (params.get('sent') === '1') {
    status.textContent =
        'Merci ! Votre demande a été enregistrée et transmise.';
}
</script>

<script>
(() => {
  const translations = {
    "Services":"Services","Logiciels":"Software","Notre approche":"Our approach",
    "Parlons de votre projet":"Let's discuss your project",
    "Développement logiciel & solutions numériques":"Software development & digital solutions",
    "Des idées solides.":"Strong ideas.","Des logiciels":"Software that is",
    "utiles.":"useful.","Hianpe accompagne vos projets numériques avec des applications sur mesure, des outils métier et des solutions web conçues pour répondre à vos vrais besoins.":"Hianpe supports your digital projects with custom applications, business tools and web solutions designed around your real needs.",
    "Parler de mon projet":"Discuss my project","Découvrir les logiciels ↓":"Explore our software ↓",
    "Solutions pensées pour être pratiques, fiables et évolutives.":"Practical, reliable and scalable solutions.",
    "C# · .NET":"C# · .NET","// Une solution pensée pour vous":"// A solution designed for you",
    "Sur mesure":"Custom-built","Vos besoins, votre outil":"Your needs, your tool",
    "Évolutif":"Scalable","Conçu pour progresser":"Built to grow",
    "Windows · Linux prévu selon version":"Windows · Linux support depends on release",
    "Outils pratiques":"Practical tools",
    "Hianpe. Des solutions numériques pensées pour durer.":"Hianpe. Digital solutions built to last.",
    "Retour à l'accueil ↗":"Back to home ↗","Du concept au produit ✓":"From concept to product ✓",
    "Ce que nous faisons":"What we do","La bonne technologie":"The right technology",
    "pour le bon problème.":"for the right problem.",
    "Du premier échange à la mise en production, nous privilégions des solutions claires, maintenables et adaptées à votre réalité.":"From the first conversation to launch, we focus on clear, maintainable solutions tailored to your needs.",
    "Applications C# / .NET":"C# / .NET applications",
    "Logiciels métier, outils internes, automatisation de tâches et applications adaptées à vos processus.":"Business software, internal tools, task automation and applications tailored to your workflows.",
    "Décrire mon besoin":"Describe my needs","Applications de bureau":"Desktop applications",
    "Interfaces desktop modernes avec Avalonia UI et .NET, pour créer des outils multiplateformes quand le projet s'y prête.":"Modern desktop interfaces with Avalonia UI and .NET, building cross-platform tools when appropriate.",
    "Créer un logiciel":"Build software","Sites et applications web":"Websites and web applications",
    "Sites professionnels, interfaces web et applications Blazor ou ASP.NET Core orientées simplicité et performance.":"Professional websites, web interfaces and Blazor or ASP.NET Core applications focused on simplicity and performance.",
    "Lancer un projet web":"Start a web project","Maintenance & évolution":"Maintenance & improvements",
    "Corrections, amélioration d'interfaces, refactorisation et ajout de fonctionnalités à un projet existant.":"Bug fixes, interface improvements, refactoring and new features for existing projects.",
    "Améliorer l'existant":"Improve an existing project","Automatisation":"Automation",
    "Réduisez les tâches répétitives grâce à des utilitaires et des flux de travail adaptés à votre équipe.":"Reduce repetitive tasks with utilities and workflows tailored to your team.",
    "Gagner du temps":"Save time","Conseil technique":"Technical consulting",
    "Choix d'architecture, cadrage de projet et accompagnement pour avancer avec des décisions techniques éclairées.":"Architecture choices, project scoping and guidance to help you make informed technical decisions.",
    "Échanger avec Hianpe":"Talk to Hianpe","Catalogue Hianpe":"Hianpe catalogue",
    "Des logiciels à découvrir.":"Software to explore.","Un catalogue qui grandit.":"A growing catalogue.",
    "Retrouvez ici les applications publiées par Hianpe. Les liens de téléchargement seront ajoutés au fur et à mesure des versions officiellement disponibles.":"Explore applications published by Hianpe. Download links will be added as verified releases become available.",
    "Application desktop":"Desktop application","Outil de présentation conçu pour accompagner les équipes et les églises dans la gestion de leurs diapositives et médias.":"Presentation software designed to help teams and churches manage slides and media.",
    "Suivre le projet sur GitHub ↗":"Follow the project on GitHub ↗",
    "Outils métier":"Business tools","Utilitaires Hianpe":"Hianpe utilities",
    "Une collection d'outils pratiques pour simplifier des tâches du quotidien et améliorer la productivité.":"A collection of practical tools to simplify everyday tasks and improve productivity.",
    "Versions à venir":"Upcoming versions","Bientôt disponible":"Coming soon",
    "Projets personnalisés":"Custom projects","Votre prochain logiciel":"Your next software project",
    "Vous avez une idée d'application ou un besoin précis ? Hianpe peut étudier la création d'une solution adaptée.":"Have an app idea or a specific need? Hianpe can explore building a solution tailored to you.",
    "Présenter mon idée ↗":"Share my idea ↗",
    "Note : aucun fichier d'installation n'est proposé ici tant qu'une version vérifiée n'est pas publiée. Les plateformes compatibles et les notes de version seront précisées sur chaque fiche de téléchargement.":"Note: installers are not offered here until a verified release is published. Supported platforms and release notes will be provided with each download.",
    "Une méthode claire":"A clear process","Un projet bien cadré":"A well-defined project",
    "avance mieux.":"moves forward.","Une collaboration simple, avec des étapes compréhensibles et une attention portée à l'utilité du résultat final.":"A straightforward collaboration, with clear steps and a focus on delivering useful results.",
    "ÉTAPE 01":"STEP 01","Comprendre":"Understand","Nous clarifions vos objectifs, vos utilisateurs et les contraintes du projet.":"We clarify your goals, users and project constraints.",
    "ÉTAPE 02":"STEP 02","Proposer":"Plan","Nous définissons une solution réaliste, les fonctionnalités et les priorités.":"We define a realistic solution, features and priorities.",
    "ÉTAPE 03":"STEP 03","Construire":"Build","Le développement avance par étapes, avec des retours réguliers.":"Development progresses in stages, with regular feedback.",
    "ÉTAPE 04":"STEP 04","Faire évoluer":"Improve","Nous préparons une base claire pour corriger, maintenir et améliorer le produit.":"We create a solid foundation to fix, maintain and improve the product.",
    "Votre projet commence ici":"Your project starts here","Et si on construisait quelque chose d'utile ?":"What if we built something useful?",
    "Présentez votre besoin, même s'il n'est encore qu'une idée. Nous pourrons définir ensemble la prochaine étape.":"Tell us what you need, even if it is only an idea. Together, we can define the next step.",
    "Discuter de votre projet ↗":"Discuss your project ↗","Contact":"Contact",
    "Parlons de ce que vous voulez créer.":"Let's talk about what you want to build.",
    "Pour préparer un premier échange, pensez à préciser le problème à résoudre, les personnes qui utiliseront la solution et les fonctionnalités les plus importantes.":"To prepare for an initial conversation, describe the problem to solve, who will use the solution and the most important features.",
    "Présentez votre projet":"Tell us about your project",
    "Vous pouvez écrire directement à chrisbouk@outlook.fr pour présenter votre besoin, vos utilisateurs et les fonctionnalités recherchées.":"Email chrisbouk@outlook.fr directly to describe your needs, users and desired features.",
    "Écrire à Hianpe ↗":"Email Hianpe ↗","Dépôt GitHub ↗":"GitHub repository ↗",
    "Courriel :":"Email:","Des solutions numériques pensées pour durer.":"Digital solutions built to last.",
    "Bientôt disponible":"Coming soon","Accueil ↗":"Home ↗","Retour à l'accueil":"Back to home",
    "Contact Hianpe":"Contact Hianpe","Parlons de votre":"Let's discuss your",
    "projet.":"project.","Une idée d'application, un logiciel à améliorer ou un besoin à automatiser ? Décrivez-nous votre objectif. Même si votre projet n'est pas encore entièrement défini, nous pouvons commencer par en discuter.":"An app idea, software to improve or a process to automate? Tell us what you want to achieve. Even if your project is not fully defined yet, we can start by talking it through.",
    "Restons en contact":"Let's stay in touch","Un premier échange, simplement.":"Let's start with a conversation.",
    "Quelques informations sur votre besoin nous aideront à mieux comprendre votre projet.":"A little information about your needs will help us better understand your project.",
    "Adresse e-mail":"Email address","Domaines":"Areas of expertise",
    "Développement C# / .NET, applications de bureau, solutions web, maintenance et automatisation.":"C# / .NET development, desktop applications, web solutions, maintenance and automation.",
    "Pour gagner du temps":"To save time","Précisez le résultat attendu, les fonctionnalités prioritaires et, si vous en avez une, votre échéance.":"Tell us your expected outcome, priority features and, if applicable, your deadline.",
    "← Retour à l'accueil":"← Back to home","Présentez votre besoin":"Tell us what you need",
    "Remplissez les champs ci-dessous. Votre application de messagerie s'ouvrira avec le message préparé, prêt à être envoyé.":"Fill in the fields below. Your email application will open with a prepared message, ready to send.",
    "Votre nom *":"Your name *","Nom et prénom":"Full name","Votre adresse e-mail *":"Your email address *",
    "Sujet de votre demande *":"Request subject *","Choisissez un sujet":"Choose a subject",
    "Développement C# / .NET":"C# / .NET development","Logiciel ou application sur mesure":"Custom software or application",
    "Site web / application web":"Website / web application","Maintenance ou correction":"Maintenance or bug fix",
    "Autre demande":"Other request","Votre message *":"Your message *",
    "Décrivez votre projet, le problème à résoudre et les fonctionnalités souhaitées…":"Describe your project, the problem to solve and the features you need…",
    "Évitez d'inclure des mots de passe ou des informations confidentielles.":"Do not include passwords or confidential information.",
    "Envoyer ma demande ↗":"Send my request ↗","Votre demande sera enregistrée après validation du formulaire.":"Your request will be saved after the form is submitted.",
    "Merci ! Votre demande a été enregistrée.":"Thank you! Your request has been saved.",
    "Votre demande est enregistrée, mais l’e-mail n’a pas pu être envoyé.":"Your request was saved, but the email could not be sent.",
    "Merci ! Votre demande a été enregistrée et transmise.":"Thank you! Your request has been saved and sent."
  };
  const attributes = {
    "Ouvrir le menu":"Open menu","Fermer le menu":"Close menu",
    "Hianpe, accueil":"Hianpe, home","Logo Hianpe":"Hianpe logo",
    "Hianpe conçoit des applications sur mesure en C#/.NET, des logiciels de bureau et des solutions web modernes.":"Hianpe builds custom C#/.NET applications, desktop software and modern web solutions.",
    "Contactez Hianpe pour votre projet de développement logiciel C#/.NET, application web ou assistance technique.":"Contact Hianpe about your C#/.NET software development project, web application or technical support.",
    "Contact — Hianpe":"Contact — Hianpe","Hianpe — Des solutions numériques qui vous ressemblent":"Hianpe — Digital solutions that fit your needs"
  };
  const normalise = value => value.replace(/\s+/g, ' ').trim();
  function setLanguage(language) {
    document.documentElement.lang = language;
    document.querySelectorAll('.language-toggle').forEach(button => {
      button.textContent = language === 'fr' ? 'EN' : 'FR';
      button.setAttribute('aria-label', language === 'fr' ? 'Switch to English' : 'Passer en français');
      button.setAttribute('title', language === 'fr' ? 'Switch to English' : 'Passer en français');
    });
    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
    let node;
    while ((node = walker.nextNode())) {
      const current = normalise(node.nodeValue);
      if (!current) continue;
      const translated = translations[current];
      if (language === 'en' && translated) {
        const leading = node.nodeValue.match(/^\s*/)?.[0] || '';
        const trailing = node.nodeValue.match(/\s*$/)?.[0] || '';
        node.nodeValue = leading + translated + trailing;
      } else if (language === 'fr') {
        const french = Object.keys(translations).find(key => translations[key] === current);
        if (french) {
          const leading = node.nodeValue.match(/^\s*/)?.[0] || '';
          const trailing = node.nodeValue.match(/\s*$/)?.[0] || '';
          node.nodeValue = leading + french + trailing;
        }
      }
    }
    document.querySelectorAll('[placeholder],[aria-label],[alt],[title],meta[name="description"]').forEach(element => {
      const attrs = ['placeholder','aria-label','alt','title','content'];
      attrs.forEach(attr => {
        if (!element.hasAttribute(attr)) return;
        const value = element.getAttribute(attr);
        if (language === 'en' && attributes[value]) element.setAttribute(attr, attributes[value]);
        if (language === 'fr') {
          const french = Object.keys(attributes).find(key => attributes[key] === value);
          if (french) element.setAttribute(attr, french);
        }
      });
    });
    document.title = language === 'en'
      ? (location.pathname === '/contact' ? 'Contact — Hianpe' : 'Hianpe — Digital solutions that fit your needs')
      : (location.pathname === '/contact' ? 'Contact — Hianpe' : 'Hianpe — Des solutions numériques qui vous ressemblent');
    const languageField = document.getElementById('language-field');
    if (languageField) languageField.value = language;
    try { localStorage.setItem('hianpe-language', language); } catch (error) {}
  }
  document.querySelectorAll('.language-toggle').forEach(button => {
    button.addEventListener('click', () => {
      const current = document.documentElement.lang === 'en' ? 'en' : 'fr';
      setLanguage(current === 'fr' ? 'en' : 'fr');
    });
  });
  let saved = 'fr';
  try { saved = localStorage.getItem('hianpe-language') || 'fr'; } catch (error) {}
  setLanguage(saved === 'en' ? 'en' : 'fr');
})();
</script>
</body></html>
HTML
        , Response::HTTP_OK, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}

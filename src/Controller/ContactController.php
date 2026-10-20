<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


final class ContactController
{
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function __invoke(Request $request,
    EntityManagerInterface $entityManager): Response
    {

    if ($request->isMethod('POST')) {
        $name = trim((string) $request->request->get('name', ''));
        $email = trim((string) $request->request->get('email', ''));
        $subject = trim((string) $request->request->get('subject', ''));
        $message = trim((string) $request->request->get('message', ''));

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

        return new RedirectResponse('/contact?sent=1');
    }
        return new Response(<<<'HTML'
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Contactez Hianpe pour votre projet de développement logiciel C#/.NET, application web ou assistance technique.">
<meta name="theme-color" content="#171714"><title>Contact — Hianpe</title>
<style>
:root{--ink:#171714;--paper:#f5f0e6;--yellow:#f5c542;--muted:#6f6b62;--line:rgba(23,23,20,.14);--white:#fffdf8;--max:1120px}*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,system-ui,-apple-system,"Segoe UI",sans-serif;line-height:1.6}a{color:inherit;text-decoration:none}.wrap{width:min(var(--max),calc(100% - 40px));margin:auto}.topbar{position:sticky;top:0;background:rgba(245,240,230,.94);backdrop-filter:blur(12px);border-bottom:1px solid var(--line)}.nav{height:78px;display:flex;align-items:center;justify-content:space-between;gap:20px}.brand{display:flex;align-items:center;gap:11px;font-weight:900;font-size:1.35rem;letter-spacing:-.04em}.brand img{width:44px;height:44px;object-fit:contain;border-radius:10px}.navlinks{display:flex;align-items:center;gap:24px;font-weight:700;font-size:.92rem}.navlinks a:hover,.footer a:hover{opacity:.7}.button{display:inline-flex;align-items:center;justify-content:center;gap:9px;background:var(--ink);color:var(--white);border:1px solid var(--ink);border-radius:999px;padding:13px 19px;font-weight:800;font-size:.92rem;cursor:pointer;transition:transform .2s}.button:hover{transform:translateY(-2px)}.button.yellow{background:var(--yellow);border-color:var(--yellow);color:var(--ink)}.button.outline{background:transparent;color:var(--ink)}.hero{padding:74px 0 42px}.eyebrow{display:inline-flex;align-items:center;gap:9px;text-transform:uppercase;letter-spacing:.14em;font-size:.74rem;font-weight:900;color:#6b5a22}.eyebrow:before{content:"";width:25px;height:2px;background:var(--yellow)}h1,h2,h3,p{margin-top:0}h1{font-size:clamp(3rem,7vw,5.4rem);letter-spacing:-.075em;line-height:.98;margin:20px 0}.hero h1 span{background:var(--yellow);padding:0 .1em}.hero p{font-size:1.1rem;color:var(--muted);max-width:680px;margin:0}.layout{display:grid;grid-template-columns:.8fr 1.2fr;gap:26px;padding:18px 0 86px;align-items:start}.info{background:var(--ink);color:var(--white);padding:30px;border-radius:24px}.info h2{font-size:1.75rem;letter-spacing:-.045em;margin:14px 0}.info>p{color:#c4c1b6;font-size:.94rem}.info-item{border-top:1px solid #41413a;padding:19px 0}.info-label{color:#b6b3a7;font-size:.75rem;text-transform:uppercase;letter-spacing:.12em;font-weight:800;margin-bottom:7px}.info-item a{color:var(--yellow);font-weight:750;overflow-wrap:anywhere}.info-item p{margin:0;color:#f4f0e6;font-size:.94rem}.back{display:inline-block;margin-top:12px;font-weight:800;font-size:.9rem}.form-card{background:var(--white);border:1px solid var(--line);border-radius:24px;padding:clamp(22px,4vw,38px)}.form-card h2{font-size:1.85rem;letter-spacing:-.05em;margin-bottom:8px}.form-intro{color:var(--muted);font-size:.94rem;margin-bottom:25px}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.field{display:flex;flex-direction:column;gap:7px}.field.full{grid-column:1/-1}label{font-size:.86rem;font-weight:800}input,select,textarea{font:inherit;color:var(--ink);width:100%;border:1px solid #d8d1c4;border-radius:12px;background:#fffefa;padding:13px 14px;outline:none}input:focus,select:focus,textarea:focus{border-color:#b38a0c;box-shadow:0 0 0 3px #f5c54245}textarea{min-height:150px;resize:vertical}.hint,.notice{font-size:.8rem;color:var(--muted)}.form-actions{display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-top:22px}.notice{margin:17px 0 0}.footer{background:var(--ink);color:#b9b6ab;padding:25px 0;font-size:.83rem}.footer-inner{display:flex;justify-content:space-between;gap:20px;align-items:center}@media(max-width:760px){.hero{padding:54px 0 30px}.layout{grid-template-columns:1fr;padding-bottom:58px}.navlinks{gap:13px}.info{order:2}.form-card{order:1}}@media(max-width:520px){.wrap{width:calc(100% - 28px)}.nav{height:70px}.brand img{width:39px;height:39px}.navlinks>a:not(.button){display:none}.navlinks .button{font-size:.82rem;padding:10px 13px}.hero{padding-top:44px}h1{font-size:clamp(2.8rem,14vw,4rem)}.form-grid{grid-template-columns:1fr}.field.full{grid-column:auto}.footer-inner{align-items:flex-start;flex-direction:column}}@media(prefers-reduced-motion:reduce){*,*:before,*:after{transition:none!important}}
</style>
</head>
<body>
<header class="topbar"><div class="wrap nav"><a class="brand" href="/" aria-label="Hianpe, accueil"><img src="/assets/logo_hianpe.png" alt="Logo Hianpe">Hianpe</a><nav class="navlinks" aria-label="Navigation principale"><a href="/#services">Services</a><a href="/#logiciels">Logiciels</a><a class="button" href="/">Accueil ↗</a></nav></div></header>
<main>
<section class="hero"><div class="wrap"><div class="eyebrow">Contact Hianpe</div><h1>Parlons de votre <span>projet.</span></h1><p>Une idée d'application, un logiciel à améliorer ou un besoin à automatiser ? Décrivez-nous votre objectif. Même si votre projet n'est pas encore entièrement défini, nous pouvons commencer par en discuter.</p></div></section>
<section class="wrap layout">
<aside class="info"><div class="eyebrow">Restons en contact</div><h2>Un premier échange, simplement.</h2><p>Quelques informations sur votre besoin nous aideront à mieux comprendre votre projet.</p>
<div class="info-item"><div class="info-label">Adresse e-mail</div><a href="mailto:chrisbouk@outlook.fr">chrisbouk@outlook.fr ↗</a></div>
<div class="info-item"><div class="info-label">Domaines</div><p>Développement C# / .NET, applications de bureau, solutions web, maintenance et automatisation.</p></div>
<div class="info-item"><div class="info-label">Pour gagner du temps</div><p>Précisez le résultat attendu, les fonctionnalités prioritaires et, si vous en avez une, votre échéance.</p></div><a class="back" href="/">← Retour à l'accueil</a>
</aside>
<section class="form-card" aria-labelledby="form-title"><h2 id="form-title">Présentez votre besoin</h2><p class="form-intro">Remplissez les champs ci-dessous. Votre application de messagerie s'ouvrira avec le message préparé, prêt à être envoyé.</p>
<form id="contact-form" action="/contact" method="post"><div class="form-grid">
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
if (params.get('sent') === '1') {
    document.getElementById('form-status').textContent =
        'Merci ! Votre demande a été enregistrée.';
}
</script>
</body></html>
HTML
        , Response::HTTP_OK, ['Content-Type' => 'text/html; charset=UTF-8']);
    }
}

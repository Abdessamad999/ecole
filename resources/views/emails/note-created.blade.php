{{-- 
<h1>Bonjour ms/mr{{ $data['eleve']->nom }},</h1>

<p>Une note de {{ $data['note'] }} 
    a été ajoutée pour la matière {{ $data['matiere']->nom }}.</p> --}}

    <h2 style="text-align: center">Bonjour {{ $data['eleve']->nom }}{{ $data['eleve']->prenom }},</h2>
    <hr style="align-items: center">
    <p>Une nouvelle note a été ajoutée pour la matière {{  $data['matiere']->nom }} :</p>
    <ul>
        <li>Date :  {{$data['note']}}</li>
    </ul>
    <p>Merci,</p>
    <p>L'équipe éducative</p>
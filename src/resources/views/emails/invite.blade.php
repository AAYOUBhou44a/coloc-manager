<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; padding: 20px; }
        .card { max-width: 600px; margin: auto; background: #ffffff; padding: 40px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center; }
        .logo { color: #064e3b; font-size: 24px; font-weight: bold; margin-bottom: 20px; }
        .h1 { color: #111; font-size: 22px; margin-bottom: 10px; }
        .coloc-name { color: #064e3b; font-size: 28px; font-weight: 900; margin: 15px 0; }
        .btn { display: inline-block; background-color: #064e3b; color: #ffffff !important; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .footer { font-size: 12px; color: #999; margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
    <div class="logo">🏠 EasyColoc</div>
    
    <div class="h1">Nouvelle Invitation</div>
    
    <p><strong>{{ $owner }}</strong> vous invite à rejoindre sa colocation :</p>
    
    <div class="coloc-name">"{{ $colocation }}"</div>
    
    <p>Souhaitez-vous rejoindre cette colocation et commencer à partager vos frais ?</p>
    
    <div style="margin-top: 30px;">
        <a href="{{ $url }}" 
           style="display: inline-block; background-color: #064e3b; color: #ffffff !important; padding: 15px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-right: 10px;">
            Accepter l'invitation
        </a>

        <a href="{{route('invitations.reject', $token)}}" 
           style="display: inline-block; background-color: #f3f4f6; color: #374151 !important; padding: 15px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; border: 1px solid #d1d5db;">
            Refuser
        </a>
    </div>

    <div class="footer">
        <p>Si vous refusez, l'expéditeur en sera informé et ce lien sera désactivé.</p>
    </div>
</div>
</body>
</html>
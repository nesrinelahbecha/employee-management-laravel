<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — GEP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">

    <div class="min-h-screen flex">

        {{-- Colonne gauche : formulaire --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-sm">

                <div class="flex items-center gap-2 mb-10">
                    <div class="w-9 h-9 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">GP</div>
                    <span class="font-semibold text-slate-800">Gestion Employés & Projets</span>
                </div>

                <h1 class="text-2xl font-bold text-slate-900 mb-1">Bon retour 👋</h1>
                <p class="text-sm text-slate-500 mb-8">Connectez-vous pour accéder à votre espace.</p>

                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 text-sm px-4 py-3 rounded-lg mb-5 border border-red-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="vous@entreprise.com"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Mot de passe</label>
                        <input type="password" name="password" required
                               placeholder="••••••••"
                               class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition shadow-sm shadow-indigo-200">
                        Se connecter
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-8">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Créer un compte</a>
                </p>
            </div>
        </div>

        {{-- Colonne droite : vraie photo + overlay --}}
        <div class="hidden lg:block w-1/2 relative">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=1200&auto=format&fit=crop"
                 alt="Équipe au travail"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/90 via-indigo-900/50 to-indigo-900/20"></div>

            <div class="relative z-10 h-full flex flex-col justify-end p-16 text-white">
                <p class="text-indigo-200 text-sm font-medium mb-3 tracking-wide">PLATEFORME RH & PROJETS</p>
                <h2 class="text-3xl font-bold leading-snug mb-5">
                    Pilotez vos équipes<br>et vos projets,<br>en un seul endroit.
                </h2>
                <p class="text-indigo-100 text-sm leading-relaxed max-w-sm mb-8">
                    Suivi des employés, des départements et de l'avancement de chaque projet — centralisé et simple d'usage.
                </p>

                
            </div>
        </div>

    </div>

</body>
</html>
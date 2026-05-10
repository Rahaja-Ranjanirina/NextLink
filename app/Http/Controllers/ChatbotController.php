<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1500'
        ]);

        $message = $request->message;
        $apiKey = env('GROQ_API_KEY');
        
        // Si pas de clé API, utiliser le mode hors-ligne
        if (!$apiKey) {
            return $this->offlineResponse($message);
        }
        
        // Prompt système pour l'IA
        $systemPrompt = "Tu es TELECOM-BOT, un assistant IA expert en Télécommunications et Réseaux pour étudiants.
        
Tu réponds uniquement aux questions sur les télécoms: 5G, fibre optique, reseaux IP, VLAN, TCP/IP, OSI, CCNA, stages, emplois, salaires, CV, entretiens.
Sois concis (max 5 phrases). Utilise des emojis. Soit professionnel et amical.
Si la question n'est pas sur les telecoms, dis poliment que tu es specialise en telecoms.

Question: " . $message;
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);
            
            if ($response->successful()) {
                $result = $response->json();
                $botResponse = $result['choices'][0]['message']['content'];
                return response()->json([
                    'success' => true,
                    'response' => $botResponse
                ]);
            } else {
                return $this->offlineResponse($message);
            }
            
        } catch (\Exception $e) {
            Log::error('GROQ API Error: ' . $e->getMessage());
            return $this->offlineResponse($message);
        }
    }
    
    // Mode hors-ligne simple (fonctionne sans API)
    private function offlineResponse($message)
    {
        $msg = strtolower($message);
        
        $reponses = [
            '5g' => "📶 La 5G est la 5eme generation mobile. Avantages: debit jusqu a 10 Gbit/s, latence <1ms, 1 million d appareils/km².",
            'fibre' => "🔍 La fibre optique utilise la lumiere pour transmettre des donnees a tres haut debit. Technologies: GPON, FTTH.",
            'ccna' => "🎓 CCNA est la certification Cisco de base. Tres recherchee par les recruteurs. Salaire debutant: 35-50k€.",
            'stage' => "💼 Stages telecom: Orange, SFR, Free, Bouygues, Cisco, Capgemini. Candidature spontanee sur LinkedIn.",
            'cv' => "📄 CV telecom: mettez en avant projets reseau, certifications, competences techniques (VLAN, routage), anglais.",
            'tcp' => "🌐 TCP est fiable avec accuse reception. UDP est rapide mais non fiable. TCP pour web, UDP pour streaming.",
            'vlan' => "🔌 Un VLAN isole le trafic sur un commutateur. Ameliore securite et performance.",
            'salaire' => "💰 Ingénieur réseau junior: 40-50k€. Technicien fibre: 28-35k€. Admin réseau: 35-45k€.",
        ];
        
        foreach ($reponses as $mot => $reponse) {
            if (str_contains($msg, $mot)) {
                return response()->json(['success' => true, 'response' => $reponse]);
            }
        }
        
        return response()->json([
            'success' => true,
            'response' => "📡 Je suis TELECOM-BOT. Posez-moi des questions sur: 5G, fibre, CCNA, stages, salaires, reseaux. Que voulez-vous savoir?"
        ]);
    }
}
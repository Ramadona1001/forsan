<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have at least 2 users
        if (User::count() < 2) {
            User::factory()->count(2)->create();
        }

        $user1 = User::first(); // Assumed to be the logged in user for testing
        $user2 = User::where('id', '!=', $user1->id)->first();

        // Create Conversation
        $conversation = Conversation::create([
            'user_one_id' => $user1->id,
            'user_two_id' => $user2->id,
        ]);

        // Create Messages
        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user2->id,
            'content' => 'Hello! How can I help you today?',
            'created_at' => now()->subMinutes(10),
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user1->id,
            'content' => 'Hi, I have a question about my booking.',
            'created_at' => now()->subMinutes(5),
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user2->id,
            'content' => 'Sure, go ahead.',
            'created_at' => now()->subMinutes(1),
        ]);
    }
}

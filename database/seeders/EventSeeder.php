<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;

class EventSeeder extends Seeder {
    public function run(): void {
        $proposers = User::where('role', 'proposer')->get();
        $categories = Category::all()->keyBy('name');

        if ($proposers->isEmpty() || $categories->isEmpty()) return;

        $events = [
            [
                'title' => 'Annual Tech Innovation Summit 2024',
                'description' => 'Join us for the biggest technology conference of the year! Industry leaders, startups, and students gather to explore the latest trends in AI, machine learning, cloud computing, and cybersecurity. Featuring keynote speeches, panel discussions, live demos, and networking sessions. Don\'t miss the opportunity to connect with over 200 professionals.',
                'date' => now()->addDays(10)->format('Y-m-d'),
                'time' => '09:00',
                'location' => 'Main Auditorium, Engineering Block',
                'category' => 'Tech',
                'theme' => 'Future of Technology',
                'max_attendees' => 200,
            ],
            [
                'title' => 'Web Development Workshop for Beginners',
                'description' => 'An intensive hands-on workshop covering HTML, CSS, JavaScript, and introductory React. Perfect for students with no prior coding experience. Participants will build a fully functional personal portfolio website from scratch. Laptops required. Limited seats available to ensure personalized attention from our experienced instructors.',
                'date' => now()->addDays(14)->format('Y-m-d'),
                'time' => '10:00',
                'location' => 'Computer Lab 3, Science Block',
                'category' => 'Workshop',
                'theme' => 'Learn to Code',
                'max_attendees' => 40,
            ],
            [
                'title' => 'International Cultural Festival',
                'description' => 'Celebrate the rich diversity of our university community! Students from over 30 countries will showcase their traditional music, dance, art, and cuisine. The festival features live performances on the main stage, cultural stalls, traditional food tasting, and interactive activities. A wonderful opportunity to experience global cultures without leaving campus.',
                'date' => now()->addDays(20)->format('Y-m-d'),
                'time' => '14:00',
                'location' => 'University Central Park',
                'category' => 'Cultural',
                'theme' => 'Unity in Diversity',
                'max_attendees' => 500,
            ],
            [
                'title' => 'Machine Learning Research Seminar',
                'description' => 'A specialized seminar presenting the latest research in machine learning and artificial intelligence. Professors and PhD candidates will present their ongoing work in natural language processing, computer vision, and reinforcement learning. Open to all students and faculty. Q&A sessions follow each presentation. Research papers available at the door.',
                'date' => now()->addDays(7)->format('Y-m-d'),
                'time' => '11:00',
                'location' => 'Seminar Hall B, Research Center',
                'category' => 'Seminar',
                'theme' => 'AI Research Frontiers',
                'max_attendees' => 80,
            ],
            [
                'title' => 'Inter-University Basketball Championship',
                'description' => 'The annual basketball championship returns with teams from 12 universities competing for the trophy. Watch high-energy games across the weekend, cheer for your team, and enjoy live commentary and sports analysis. Food stalls and merchandise available. The finals will be streamed live on the university sports channel. Come support our home team!',
                'date' => now()->addDays(25)->format('Y-m-d'),
                'time' => '08:00',
                'location' => 'University Sports Complex',
                'category' => 'Sports',
                'theme' => 'Champion Spirit',
                'max_attendees' => 300,
            ],
            [
                'title' => 'Entrepreneurship Bootcamp: From Idea to Launch',
                'description' => 'A three-day intensive bootcamp designed to take your business idea from concept to a fundable pitch. Topics include market research, business model canvas, financial planning, branding, and investor relations. Mentors include successful startup founders and venture capitalists. Participants pitch to a panel of investors on the final day. Certificate provided on completion.',
                'date' => now()->addDays(18)->format('Y-m-d'),
                'time' => '09:30',
                'location' => 'Business Innovation Hub',
                'category' => 'Conference',
                'theme' => 'Startup Mindset',
                'max_attendees' => 60,
            ],
            [
                'title' => 'Photography Masterclass: Storytelling Through Lens',
                'description' => 'Learn the art of visual storytelling with professional photographer Marcus Johnson. This one-day masterclass covers composition, lighting, portrait and landscape photography, and post-processing techniques using Adobe Lightroom. Both beginners and intermediate photographers welcome. Bring your camera — DSLR, mirrorless, or even a smartphone.',
                'date' => now()->addDays(12)->format('Y-m-d'),
                'time' => '10:00',
                'location' => 'Arts Studio, Creative Block',
                'category' => 'Workshop',
                'theme' => 'Visual Arts',
                'max_attendees' => 30,
            ],
            [
                'title' => 'Mental Health Awareness Week Kickoff',
                'description' => 'Launching our annual Mental Health Awareness Week with an open forum on student wellbeing. Mental health professionals, counselors, and peer support volunteers will share resources, coping strategies, and lived experiences. Free stress-relief kits available. Anonymous Q&A through a live submission portal. All students and staff are warmly welcomed.',
                'date' => now()->addDays(5)->format('Y-m-d'),
                'time' => '13:00',
                'location' => 'Student Union Hall',
                'category' => 'Social',
                'theme' => 'Your Mind Matters',
                'max_attendees' => 150,
            ],
            [
                'title' => 'Cybersecurity Hackathon 2024',
                'description' => 'A 24-hour hackathon challenging teams to solve real-world cybersecurity problems. Categories include ethical hacking, secure coding, network defense, and forensics. Teams of 2–4 students compete for cash prizes and internship opportunities with our sponsor companies. Meals and refreshments provided throughout the event. Registration closes one week before the event.',
                'date' => now()->addDays(30)->format('Y-m-d'),
                'time' => '10:00',
                'location' => 'Innovation Lab, Technology Center',
                'category' => 'Tech',
                'theme' => 'Hack the Future',
                'max_attendees' => 100,
            ],
            [
                'title' => 'Annual Career Fair & Networking Expo',
                'description' => 'Over 50 companies from technology, finance, healthcare, and engineering sectors will be present to meet students and recent graduates. Bring your resume and professional attire. On-spot interviews available for selected positions. Resume review booths staffed by HR professionals. Industry panels on career development and graduate recruitment trends run throughout the day.',
                'date' => now()->addDays(35)->format('Y-m-d'),
                'time' => '09:00',
                'location' => 'Exhibition Hall, Student Center',
                'category' => 'Conference',
                'theme' => 'Your Career Starts Here',
                'max_attendees' => 400,
            ],
        ];

        foreach ($events as $i => $data) {
            $proposer = $proposers->get($i % $proposers->count());
            $category = $categories->get($data['category']);

            if (!$category) continue;

            Event::create([
                'user_id' => $proposer->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'date' => $data['date'],
                'time' => $data['time'],
                'location' => $data['location'],
                'category_id' => $category->id,
                'theme' => $data['theme'],
                'max_attendees' => $data['max_attendees'],
                'is_active' => true,
            ]);
        }
    }
}

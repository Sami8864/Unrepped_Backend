<?php

namespace Database\Seeders;

use App\Models\Essence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EssenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actors = [
            'Adele',
            'Adriana Lima',
            'Alex Rodriguez',
            'Alexandra Daddario',
            'Alexandria Ocasio-Cortez',
            'Alicia Keys',
            'Alicia Silverstone',
            'Amal Clooney',
            'Amanda Bynes',
            'Amanda Seyfried',
            'Ana De Armas',
            'Angela Bassett',
            'Angelina Jolie',
            'Anna Faris',
            'Anne Hathaway',
            'Ariana Grande',
            'Ashley Graham',
            'Ashley Olsen',
            'Ashley Park',
            'Ashton Kutcher',
            'Ava Phillippe',
            'Barack Obama',
            'Barbie Ferreira',
            'Behati Prinsloo',
            'Bella Hadid',
            'Ben Affleck',
            'Beyonce Knowles',
            'Billie Eilish',
            'Blake Lively',
            'Blake Shelton',
            'Blue Ivy Carter',
            'Bobbi Brown',
            'Brad Pitt',
            'Bradley Cooper',
            'Britney Spears',
            'Calvin Klein',
            'Cameron Diaz',
            'Cara Delevingne',
            'Cardi B',
            'Carolina Herrera',
            'Catherine Zeta-Jones',
            'Channing Tatum',
            'Charlize Theron',
            'Chris Pratt',
            'Chrissy Teigen',
            'Christian Siriano',
            'Christie Brinkley',
            'Christina Aguilera',
            'Cindy Crawford',
            'Claire Danes',
            'Connie Britton',
            'Courteney Cox',
            'Dakota Fanning',
            'Dakota Johnson',
            'David Beckham',
            'Debra Messing',
            'Demi Lovato',
            'Demi Moore',
            'Dolly Parton',
            'Donatella Versace',
            'Drew Barrymore',
            'Dua Lipa',
            'Ed Sheeran',
            'Elizabeth Banks',
            'Elizabeth Olsen',
            'Elle Fanning',
            'Ellen DeGeneres',
            'Elliot Page',
            'Emily Blunt',
            'Emily Ratajkowski',
            'Emma Watson',
            'Eva Longoria',
            'Eva Mendes',
            'Florence Pugh',
            'Gabrielle Union',
            'Gal Gadot',
            'George Clooney',
            'Gigi Hadid',
            'Giorgio Armani',
            'Gwen Stefani',
            'Gwyneth Paltrow',
            'Hailee Steinfeld',
            'Hailey Bieber',
            'Halle Berry',
            'Harry Styles',
            'Heidi Klum',
            'Helen Mirren',
            'Hilary Duff',
            'Hillary Rodham Clinton',
            'Irina Shayk',
            'Ivanka Trump',
            'Jada Pinkett Smith',
            'Jake Gyllenhaal',
            'James Corden',
            'Janelle Monae',
            'Jay Z',
            'Jenna Dewan',
            'Jennifer Aniston',
            'Jennifer Garner',
            'Jennifer Hudson',
            'Jennifer Lawrence',
            'Jennifer Lopez',
            'Jessica Alba',
            'Jessica Biel',
            'Jessica Chastain',
            'Jessica Simpson',
            'Jill Biden',
            'Jimmy Choo',
            'Joe Biden',
            'Joe Jonas',
            'John Legend',
            'Julia Fox',
            'Julia Roberts',
            'Julianne Hough',
            'Justin Bieber',
            'Justin Theroux',
            'Justin Timberlake',
            'Kaia Gerber',
            'Kaley Cuoco',
            'Kamala Harris',
            'Kanye West',
            'Kate Beckinsale',
            'Kate Hudson',
            'Kate Mara',
            'Kate Middleton',
            'Kate Winslet',
            'Katie Holmes',
            'Katy Perry',
            'Keira Knightley',
            'Keke Palmer',
            'Kelly Ripa',
            'Kendall Jenner',
            'Kerry Washington',
            'Khloe Kardashian',
            'Kim Cattrall',
            'Kim Kardashian',
            'King Charles',
            'Kirsten Dunst',
            'Kourtney Kardashian-Barker',
            'Kris Jenner',
            'Kristen Stewart',
            'Kristin Davis',
            'Kylie Jenner',
            'Lady Gaga',
            'Lenny Kravitz',
            'Leonardo DiCaprio',
            'Lily Collins',
            'Lily James',
            'Lindsay Lohan',
            'Lisa Kudrow',
            'Lizzo',
            'Lori Loughlin',
            'Lucy Hale',
            'Lupita Nyong\'o',
            'Machine Gun Kelly',
            'Malia Obama',
            'Mandy Moore',
            'Margot Robbie',
            'Mariah Carey',
            'Marilyn Monroe',
            'Martha Stewart',
            'Mary-Kate Olsen',
            'Matt Damon',
            'Meg Ryan',
            'Megan Fox',
            'Megan Thee Stallion',
            'Meghan Markle',
            'Melissa McCarthy',
            'Michelle Obama',
            'Mila Kunis',
            'Miley Cyrus',
            'Millie Bobby Brown',
            'Mindy Kaling',
            'Miranda Kerr',
            'Naomi Campbell',
            'Nick Jonas',
            'Nicki Minaj',
            'Nicole Kidman',
            'North West',
            'Olivia Munn',
            'Olivia Rodrigo',
            'Olivia Wilde',
            'Oprah Winfrey',
            'Orlando Bloom',
            'Oscar de la Renta',
            'Paris Hilton',
            'Penelope Cruz',
            'Pete Davidson',
            'Prince George',
            'Prince Harry',
            'Prince William',
            'Princess Charlotte',
            'Princess Diana',
            'Priyanka Chopra',
            'Queen Elizabeth',
            'Quinta Brunson',
            'Reese Witherspoon',
            'Renee Zellweger',
            'Rihanna',
            'Rita Ora',
            'Robert Pattinson',
            'Rooney Mara',
            'Rosie Huntington-Whiteley',
            'Ryan Gosling',
            'Ryan Reynolds',
            'Salma Hayek Pinault',
            'Sarah Jessica Parker',
            'Scarlett Johansson',
            'Selena Gomez',
            'Serena Williams',
            'Shailene Woodley',
            'Shania Twain',
            'Shay Mitchell',
            'Simone Biles',
            'Sofia Vergara',
            'Solange Knowles',
            'Sophia Bush',
            'Sophie Turner',
            'Sydney Sweeney',
            'Taylor Swift',
            'Timothee Chalamet',
            'Tracee Ellis Ross',
            'Travis Barker',
            'Vanessa Hudgens',
            'Venus Williams',
            'Vera Wang',
            'Victoria Beckham',
            'Willow',
            'Zendaya',
            'Zoe Kravitz',
            'Zoe Saldana',
            'Aamir Khan',
            'Aishwarya Rai',
            'Akshay Kumar',
            'Alia Bhatt',
            'Amitabh Bachchan',
            'Abhishek Bachchan',
            'Anushka Sharma',
            'Arjun Kapoor',
            'Ayushmann Khurrana',
            'Deepika Padukone',
            'Disha Patani',
            'Hrithik Roshan',
            'Jacqueline Fernandez',
            'John Abraham',
            'Kajol',
            'Kangana Ranaut',
            'Kareena Kapoor Khan',
            'Kartik Aaryan',
            'Katrina Kaif',
            'Ranbir Kapoor',
            'Ranveer Singh',
            'Salman Khan',
            'Shah Rukh Khan',
            'Shahid Kapoor',
            'Shraddha Kapoor',
            'Sonakshi Sinha',
            'Sunny Leone',
            'Tiger Shroff',
            'Varun Dhawan',
            'Vidya Balan',
            'Vicky Kaushal',
            'Yami Gautam'
        ];
        foreach ($actors as $actorName) {
            Essence::create(['name' => $actorName]);
        }
    }
}
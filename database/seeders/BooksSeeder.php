<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Room;

class BooksSeeder    extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TeiRoom = Room::firstOrCreate([
            'room_name' => 'TEI',
        ], [
            'location' => 'Lantai 1',
            'status' => 'available',
        ]);

        $TkjRoom = Room::firstOrCreate([
            'room_name' => 'TKJ',
        ], [
            'location' => 'Lantai 2',
            'status' => 'available',
        ]);

        $RplRoom = Room::firstOrCreate([
            'room_name' => 'RPL',
        ], [
            'location' => 'Lantai 3',
            'status' => 'available',
        ]);

        // Contoh data Buku
        $books = [
            // Lantai 1 - Tei
            [
                'room_id' => $TeiRoom->id,
                'book_id' => 'BK-001',
                'book_name' => 'Gaming Beast',
                'author' => 'John Doe',
                'publisher' => 'Gaming Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TeiRoom->id,
                'book_id' => 'BK-002',
                'book_name' => 'FPS Destroyer',
                'author' => 'Jane Smith',
                'publisher' => 'Gaming Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TeiRoom->id,
                'book_id' => 'BK-003',
                'book_name' => 'Racing Pro',
                'author' => 'John Doe',
                'publisher' => 'Gaming Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TeiRoom->id,
                'book_id' => 'BK-004',
                'book_name' => 'VR Ready',
                'author' => 'Jane Smith',
                'publisher' => 'Gaming Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TeiRoom->id,
                'book_id' => 'BK-005',
                'book_name' => 'Streaming Station',
                'author' => 'John Doe',
                'publisher' => 'Gaming Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],

            // Lantai 2 - Tkj
            [
                'room_id' => $TkjRoom->id,
                'book_id' => 'BK-006',
                'book_name' => 'Office Workstation 1',
                'author' => 'Jane Smith',
                'publisher' => 'Office Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TkjRoom->id,
                'book_id' => 'BK-007',
                'book_name' => 'Office Workstation 2',
                'author' => 'John Doe',
                'publisher' => 'Office Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TkjRoom->id,
                'book_id' => 'BK-008',
                'book_name' => 'Accounting Book',
                'author' => 'Jane Smith',
                'publisher' => 'Office Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $TkjRoom->id,
                'book_id' => 'BK-009',
                'book_name' => 'Admin Book',
                'author' => 'John Doe',
                'publisher' => 'Office Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $RplRoom->id,
                'book_id' => 'BK-010',
                'book_name' => 'Meeting Room Book',
                'author' => 'Jane Smith',
                'publisher' => 'Office Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],

            // Lantai 3 - Rpl
            [
                'room_id' => $RplRoom->id,
                'book_id' => 'BK-011',
                'book_name' => 'Rpl Studio 1',
                'author' => 'John Doe',
                'publisher' => 'Design Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $RplRoom->id,
                'book_id' => 'BK-012',
                'book_name' => 'Rpl Studio 2',
                'author' => 'Jane Smith',
                'publisher' => 'Design Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $RplRoom->id,
                'book_id' => 'BK-013',
                'book_name' => 'Render Workstation',
                'author' => 'John Doe',
                'publisher' => 'Design Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
            [
                'room_id' => $RplRoom->id,
                'book_id' => 'BK-014',
                'book_name' => 'Graphic Designer',
                'author' => 'Jane Smith',
                'publisher' => 'Design Publishers',
                'publication_year' => 2022,
                'status' => 'available',
            ],
        ];

        // Insert data ke database
        foreach ($books as $book) {
            Book::firstOrCreate(['book_id' => $book['book_id']], $book);
        }
    }
}

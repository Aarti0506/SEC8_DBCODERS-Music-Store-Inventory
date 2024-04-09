-- Name: Shhejad Vashi
-- ID: 8936136

use musicstore;

-- Insert Data into Product Table
INSERT INTO Product (ProductID, Name, Type, Price, QuantityAvailable, ReleaseDate)
VALUES
    (1, 'CD - Greatest Hits', 'CD', 12.99, 50, '2023-01-15'),
    (2, 'Vinyl - Jazz Classics', 'Vinyl', 29.99, 30, '2022-06-20'),
    (3, 'Guitar', 'Instrument', 399.99, 20, '2023-11-10'),
    (4, 'Piano Book', 'Sheet Music', 19.99, 100, '2022-03-05'),
    (5, 'Microphone', 'Equipment', 79.99, 10, '2024-02-08');
    
    -- Insert Data into Artist Table
INSERT INTO Artist (ArtistID, Name, Genre)
VALUES
    (1, 'Michael Jackson', 'Pop'),
    (2, 'Miles Davis', 'Jazz'),
    (3, 'Jim Hendrix', 'Rock');

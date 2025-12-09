-- Seed data for Apartmani MySQL schema (6 apartments with complete translations)
USE `apartmani`;

SET FOREIGN_KEY_CHECKS = 0;

-- Insert 6 apartments
INSERT INTO `apartments` (`id`, `slug`, `price`, `beds`, `baths`, `guests`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'suite-apartment-palma', 150.00, 2, 1, 4, 4.90, NOW(), NOW()),
(2, 'suite-apartment-pinija', 120.00, 2, 1, 4, 4.80, NOW(), NOW()),
(3, 'studio-apartment-maslina', 110.00, 1, 1, 2, 4.70, NOW(), NOW()),
(4, 'suite-apartment-lavanda', 160.00, 2, 1, 4, 4.85, NOW(), NOW()),
(5, 'suite-apartment-ruzmarin', 155.00, 2, 1, 4, 4.75, NOW(), NOW()),
(6, 'studio-apartment-bor', 95.00, 1, 1, 2, 4.65, NOW(), NOW());

-- Translations (all languages: HR, EN, DE, FR) for all 6 apartments
INSERT INTO `apartment_translations` (`apartment_id`, `lang`, `name`, `sub_name`, `description`, `long_description`) VALUES
-- Apartment 1: Palma
(1, 'hr', 'Suite Apartman Palma', 'Suite 1', 'Prostrana apartman za 4 osobe s pogledom na more', 'Uživajte u ljepoti Jadrana sa svoje privatne terase. Moderni sadržaji i sjajno dnevno stanovanje čekaju vas. Idealno za obitelj ili grupu prijatelja.'),
(1, 'en', 'Suite Apartment Palma', 'Suite 1', 'Spacious suite apartment for 4 people with sea view', 'Experience the beauty of the Adriatic Sea from your private balcony. Modern amenities and a bright living area await you. Perfect for families or groups of friends.'),
(1, 'de', 'Suite Wohnung Palma', 'Suite 1', 'Geräumige Apartmantwohnung für 4 Personen mit Meerblick', 'Genießen Sie die Schönheit der Adria von Ihrem privaten Balkon. Moderne Annehmlichkeiten und ein helles Wohnzimmer erwarten Sie. Perfekt für Familien oder Freundesgruppen.'),
(1, 'fr', 'Appartement Suite Palma', 'Suite 1', 'Spacieux appartement pour 4 personnes avec vue sur la mer', 'Découvrez la beauté de la mer Adriatique depuis votre balcon privé. Des équipements modernes et un salon lumineux vous attendent. Parfait pour les familles ou les groupes d\'amis.'),

-- Apartment 2: Pinija
(2, 'hr', 'Suite Apartman Pinija', 'Suite 2', 'Ugodna apartman za 4 osobe s balkonom', 'Topao prostor s modernom kuhinjom i ugodnom spavaćom sobom, blizu plaže i restorana. Savršen za odmor u blizini centra.'),
(2, 'en', 'Suite Apartment Pinija', 'Suite 2', 'Comfortable suite apartment for 4 with balcony', 'A cozy space with modern kitchen and comfortable bedroom, close to the beach and restaurants. Perfect for a relaxing getaway near the center.'),
(2, 'de', 'Suite Wohnung Pinija', 'Suite 2', 'Komfortable Apartmantwohnung für 4 mit Balkon', 'Ein gemütlicher Raum mit moderner Küche und komfortablem Schlafzimmer, in der Nähe von Strand und Restaurants. Perfekt für einen entspannenden Aufenthalt in der Nähe des Zentrums.'),
(2, 'fr', 'Appartement Suite Pinija', 'Suite 2', 'Appartement confortable pour 4 avec balcon', 'Un espace cosy avec une cuisine moderne et une chambre confortable, près de la plage et des restaurants. Parfait pour une escapade relaxante près du centre.'),

-- Apartment 3: Maslina
(3, 'hr', 'Studio Apartman Maslina', 'Studio 3', 'Elegantan studio s pristupom vrtu', 'Prizemna apartman s lakim pristupom zajedničkom vrtu i vanjskom sjedištu. Idealna za parove ili individuals koji traže mir.'),
(3, 'en', 'Studio Apartment Maslina', 'Studio 3', 'Elegant studio with garden access', 'Ground-floor apartment with easy access to a shared garden and outdoor seating. Ideal for couples or individuals seeking tranquility.'),
(3, 'de', 'Studio Wohnung Maslina', 'Studio 3', 'Elegantes Studio mit Gartenzugang', 'Parterre-Wohnung mit leichtem Zugang zu einem gemeinsamen Garten und Außensitzplätzen. Ideal für Paare oder Einzelpersonen, die Ruhe suchen.'),
(3, 'fr', 'Studio Maslina', 'Studio 3', 'Studio élégant avec accès au jardin', 'Appartement au rez-de-chaussée avec accès facile au jardin commun et aux places assises extérieures. Idéal pour les couples ou les personnes en quête de tranquillité.'),

-- Apartment 4: Lavanda
(4, 'hr', 'Suite Apartman Lavanda', 'Suite 4', 'Luksuzna apartman za 4 osobe s balkonom', 'Premijumski namještaj s panoramskim pogledom na more. Uključuje AC, WiFi, TV i sve što trebate za ugodan boravak.'),
(4, 'en', 'Suite Apartment Lavanda', 'Suite 4', 'Luxury suite apartment for 4 with balcony', 'Premium furnishings with panoramic sea views. Includes AC, WiFi, TV and everything you need for a comfortable stay.'),
(4, 'de', 'Suite Wohnung Lavanda', 'Suite 4', 'Luxus-Apartmantwohnung für 4 mit Balkon', 'Premium-Möbel mit Panoramablick auf das Meer. Inkl. Klimaanlage, WiFi, TV und alles Notwendige für einen komfortablen Aufenthalt.'),
(4, 'fr', 'Appartement Suite Lavanda', 'Suite 4', 'Appartement de luxe pour 4 avec balcon', 'Mobilier premium avec vue panoramique sur la mer. Inclut la climatisation, WiFi, TV et tout ce dont vous avez besoin pour un séjour confortable.'),

-- Apartment 5: Ruzmarin
(5, 'hr', 'Suite Apartman Ruzmarin', 'Suite 5', 'Moderan apartman za 4 osobe s terasom', 'Kontemporaran dizajn s toplim bojama, idealan za aktivne goste. Blizu svih atrakcija Medulina.'),
(5, 'en', 'Suite Apartment Ruzmarin', 'Suite 5', 'Modern apartment for 4 with terrace', 'Contemporary design with warm colors, ideal for active guests. Close to all Medulin attractions.'),
(5, 'de', 'Suite Wohnung Ruzmarin', 'Suite 5', 'Modernes Apartment für 4 mit Terrasse', 'Zeitgenössisches Design mit warmen Farben, ideal für aktive Gäste. In der Nähe aller Sehenswürdigkeiten Medulins.'),
(5, 'fr', 'Appartement Suite Ruzmarin', 'Suite 5', 'Appartement moderne pour 4 avec terrasse', 'Design contemporain avec des couleurs chaleureuses, idéal pour les clients actifs. Près de tous les points d\'intérêt de Medulin.'),

-- Apartment 6: Bor
(6, 'hr', 'Studio Apartman Bor', 'Studio 6', 'Kompaktan studio blizu plaže', 'Mali, ali proporcionalno opremljen studio, savršen za parove i koji putuju solo. Direct pristup plaži.'),
(6, 'en', 'Studio Apartment Bor', 'Studio 6', 'Compact studio close to the beach', 'Small but well-equipped studio, perfect for couples and solo travelers. Direct beach access.'),
(6, 'de', 'Studio Wohnung Bor', 'Studio 6', 'Kompaktes Studio in Strandnähe', 'Kleines, aber gut ausgestattetes Studio, perfekt für Paare und Alleinreisende. Direkter Strandzu­gang.'),
(6, 'fr', 'Studio Bor', 'Studio 6', 'Studio compact près de la plage', 'Petit studio mais bien équipé, parfait pour les couples et les voyageurs en solo. Accès direct à la plage.');

-- Images for all 6 apartments (2-3 per apartment)
INSERT INTO `images` (`apartment_id`, `url`, `alt`, `is_featured`, `display_order`) VALUES
-- Apartment 1: Palma
(1, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Palma - Living Room', 1, 1),
(1, 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Palma - Bedroom', 0, 2),
-- Apartment 2: Pinija
(2, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Pinija - Living Room', 1, 1),
(2, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Pinija - Bedroom', 0, 2),
-- Apartment 3: Maslina
(3, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1200&auto=format&fit=crop', 'Studio Apartment Maslina - Living Room', 1, 1),
(3, 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?q=80&w=1200&auto=format&fit=crop', 'Studio Apartment Maslina - Garden View', 0, 2),
-- Apartment 4: Lavanda
(4, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Lavanda - Living Room', 1, 1),
(4, 'https://images.unsplash.com/photo-1454391304352-2bf4678b1a7a?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Lavanda - Balcony', 0, 2),
-- Apartment 5: Ruzmarin
(5, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Ruzmarin - Living Room', 1, 1),
(5, 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?q=80&w=1200&auto=format&fit=crop', 'Suite Apartment Ruzmarin - Terrace', 0, 2),
-- Apartment 6: Bor
(6, 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?q=80&w=1200&auto=format&fit=crop', 'Studio Apartment Bor - Bedroom', 1, 1),
(6, 'https://images.unsplash.com/photo-1488554347491-5a42fb42e1cd?q=80&w=1200&auto=format&fit=crop', 'Studio Apartment Bor - Beach View', 0, 2);

-- Amenities master list (explicit ids so seed mapping remains stable)
INSERT INTO `amenities` (`id`, `code`, `label`) VALUES
(1, 'air_conditioning', 'Air conditioning'),
(2, 'garden', 'Garden'),
(3, 'tv', 'TV'),
(4, 'parking', 'Parking'),
(5, 'free_wifi', 'Free WiFi'),
(6, 'coffee_maker', 'Coffee maker'),
(7, 'safe', 'Safe'),
(8, 'beach_access', 'Beach access'),
(9, 'kitchen', 'Full kitchen'),
(10, 'balcony', 'Balcony');

-- Map amenities to apartments
INSERT INTO `apartment_amenities` (`apartment_id`, `amenity_id`) VALUES
-- Apartment 1: Palma (all amenities)
(1, 1),(1, 2),(1, 3),(1, 4),(1, 5),(1, 6),(1, 7),(1, 8),(1, 9),(1, 10),
-- Apartment 2: Pinija (most amenities)
(2, 1),(2, 3),(2, 4),(2, 5),(2, 6),(2, 9),(2, 10),
-- Apartment 3: Maslina (basic + garden)
(3, 1),(3, 2),(3, 3),(3, 5),(3, 8),(3, 9),
-- Apartment 4: Lavanda (all amenities)
(4, 1),(4, 2),(4, 3),(4, 4),(4, 5),(4, 6),(4, 7),(4, 8),(4, 9),(4, 10),
-- Apartment 5: Ruzmarin (most amenities)
(5, 1),(5, 3),(5, 4),(5, 5),(5, 6),(5, 8),(5, 9),(5, 10),
-- Apartment 6: Bor (basic + beach)
(6, 1),(6, 3),(6, 5),(6, 8),(6, 9);

-- House rules for all 6 apartments
INSERT INTO `house_rules` (`apartment_id`, `rule_text`, `display_order`) VALUES
-- Apartment 1: Palma
(1, 'No smoking', 1),
(1, 'No parties or loud noise', 2),
(1, 'Check-in: 3:00 PM', 3),
(1, 'Check-out: 10:00 AM', 4),
(1, 'Max 4 guests', 5),
-- Apartment 2: Pinija
(2, 'No smoking', 1),
(2, 'Check-in: 2:00 PM', 2),
(2, 'Check-out: 11:00 AM', 3),
(2, 'Quiet hours after 11 PM', 4),
-- Apartment 3: Maslina
(3, 'No smoking', 1),
(3, 'Quiet hours: 10 PM - 8 AM', 2),
(3, 'Check-in: 3:00 PM', 3),
(3, 'Check-out: 10:00 AM', 4),
(3, 'Max 2 guests', 5),
-- Apartment 4: Lavanda
(4, 'No smoking indoors', 1),
(4, 'No pets', 2),
(4, 'Check-in: 3:00 PM', 3),
(4, 'Check-out: 10:00 AM', 4),
(4, 'Please keep noise to a minimum', 5),
(4, 'Max 4 guests', 6),
-- Apartment 5: Ruzmarin
(5, 'No smoking', 1),
(5, 'Check-in: 2:00 PM', 2),
(5, 'Check-out: 11:00 AM', 3),
(5, 'Respect quiet hours after 11 PM', 4),
-- Apartment 6: Bor
(6, 'No smoking', 1),
(6, 'Beach access - respect local rules', 2),
(6, 'Check-in: 3:00 PM', 3),
(6, 'Check-out: 10:00 AM', 4),
(6, 'Max 2 guests', 5);

SET FOREIGN_KEY_CHECKS = 1;

-- Optional: example bookings (commented out)
-- INSERT INTO `bookings` (`apartment_id`, `from_date`, `to_date`, `guests`, `nights`, `total`, `customer_name`, `customer_email`, `status`) VALUES
-- (1, '2025-07-01', '2025-07-07', 2, 6, 900.00, 'John Doe', 'john@example.com', 'confirmed'),
-- (2, '2025-08-15', '2025-08-20', 3, 5, 600.00, 'Jane Smith', 'jane@example.com', 'pending'),
-- (3, '2025-09-10', '2025-09-12', 2, 2, 220.00, 'Robert Johnson', 'robert@example.com', 'confirmed'),
-- (4, '2025-06-05', '2025-06-15', 4, 10, 1600.00, 'Maria Garcia', 'maria@example.com', 'confirmed'),
-- (5, '2025-07-20', '2025-07-27', 3, 7, 1085.00, 'Anna Wilson', 'anna@example.com', 'pending'),
-- (6, '2025-08-01', '2025-08-03', 2, 2, 190.00, 'Peter Brown', 'peter@example.com', 'confirmed');

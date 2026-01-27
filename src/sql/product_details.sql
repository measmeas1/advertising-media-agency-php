CREATE TABLE product_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    duration VARCHAR(100),
    platform VARCHAR(100),
    target_audience VARCHAR(255),
    service_includes TEXT,
    requirements TEXT,
    delivery_time VARCHAR(100),
    revisions INT DEFAULT 0,
    notes TEXT,
    image_url VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
);

ALTER TABLE product_details
ADD COLUMN service_includes TEXT AFTER target_audience,
ADD COLUMN requirements TEXT AFTER service_includes,
ADD COLUMN delivery_time VARCHAR(100) AFTER requirements,
ADD COLUMN revisions INT DEFAULT 0 AFTER delivery_time,
ADD COLUMN notes TEXT AFTER revisions;
ADD image_url VARCHAR(255) NULL;


INSERT INTO product_details 
(product_id, duration, platform, target_audience, service_includes, requirements, delivery_time, revisions, notes, image_url)
VALUES
(1, '1 Month', 'Facebook', 'Business owners, SMEs', 'Ad setup, targeting, weekly optimization, report', 'Page access, budget', '7 days', 2, 'Best for lead generation', 'https://example.com/images/facebook-ads.jpg'),
(2, '1 Month', 'Instagram', 'E-commerce, influencers', 'Creative ads, targeting, optimization, report', 'Page access, budget', '7 days', 2, 'Best for sales conversion', 'https://example.com/images/instagram-ads.jpg'),
(3, '3 Hours', 'Studio / On-site', 'Online sellers, shops', 'Product photoshoot, editing, background removal', 'Products, props, location', '3 days', 1, 'Perfect for e-commerce', 'https://example.com/images/product-photography.jpg'),
(4, '2 Videos', 'Any', 'YouTubers, businesses', 'Cutting, color correction, music, subtitles', 'Raw video files, script', '5 days', 2, 'Add more for extra cost', 'https://example.com/images/video-editing.jpg'),
(5, '1 Week', 'Branding', 'New businesses', 'Logo, color palette, typography, brand guideline', 'Business info, style preference', '7 days', 2, 'Includes 2 logo concepts', 'https://example.com/images/brand-identity.jpg'),
(6, '1 Month', 'Google / SEO', 'Website owners', 'SEO audit, keyword research, Google ads setup', 'Website access, goals', '10 days', 2, 'Best for long term growth', 'https://example.com/images/seo-google-ads.jpg'),
(7, '2 Days', 'TV / Online', 'Brands, agencies', 'Storyboarding, filming, editing, voice-over', 'Script, location, actors', '14 days', 2, 'High quality production', 'https://example.com/images/commercial-video.jpg'),
(8, '1 Event', 'PR & Media', 'Event organizers', 'Coverage, press release, media outreach', 'Event schedule, guest list', '5 days', 1, 'Includes 1 press release', 'https://example.com/images/event-pr.jpg');

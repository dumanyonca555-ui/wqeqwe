<?php
require_once '../config/database.php';

try {
    // Clear existing data
    $pdo->exec("DELETE FROM story_choices");
    $pdo->exec("DELETE FROM story_dialogues");
    $pdo->exec("DELETE FROM story_chapters");
    $pdo->exec("ALTER TABLE story_dialogues AUTO_INCREMENT = 1");
    $pdo->exec("ALTER TABLE story_choices AUTO_INCREMENT = 1");
    $pdo->exec("ALTER TABLE story_chapters AUTO_INCREMENT = 1");
    
    echo "Cleared existing story data\n";
    
    // Insert chapters first
    $chapterStmt = $pdo->prepare("INSERT INTO story_chapters (chapter_number, title, description, unlock_time, unlock_interval_hours, is_unlocked) VALUES (?, ?, ?, ?, ?, ?)");
    
    $chapters = [
        [1, 'Başlangıç', 'Gece geç saatler, Leo online\'a geçiyor', '15:30:00', 3, 1],
        [2, 'Tanışma', 'Sabah rutini ve Chloe\'nin gelişi', '18:30:00', 3, 1],
        [3, 'İlk Görev', 'Tüm karakterlerle görev tanıtımı', '21:30:00', 3, 0],
        [4, 'Gizem', 'Leo ile gizli bilgi keşfi', '00:30:00', 3, 0],
        [5, 'Hacking Challenge', 'Chloe ile teknoloji mücadelesi', '03:30:00', 3, 0],
        [6, 'Grup Yemeği', 'Felix ile sosyal etkinlik', '06:30:00', 3, 0],
        [7, 'Mentörlük Seansı', 'Elara ile kişisel gelişim', '09:30:00', 3, 0],
        [8, 'Kriz Yönetimi', 'Tüm karakterlerle kriz yönetimi', '12:30:00', 3, 0],
        [9, 'Kişisel Anlar', 'Oyuncu seçimine göre kişisel sahne', '15:30:00', 3, 0],
        [10, 'Final Confrontation', 'Klimaks ve son karar', '18:30:00', 3, 0]
    ];
    
    foreach ($chapters as $chapter) {
        $chapterStmt->execute($chapter);
    }
    
    echo "Inserted chapters\n";
    
    // Function to insert dialogue and return ID
    function insertDialogue($pdo, $chapter_id, $character_name, $dialogue_text, $order_sequence, $is_choice_point = false) {
        $stmt = $pdo->prepare("INSERT INTO story_dialogues (chapter_id, character_name, character_avatar, dialogue_text, order_sequence, is_choice_point) VALUES (?, ?, ?, ?, ?, ?)");
        $avatar = "assets/images/characters/" . strtolower($character_name) . "-portrait.png";
        $stmt->execute([$chapter_id, $character_name, $avatar, $dialogue_text, $order_sequence, $is_choice_point ? 1 : 0]);
        return $pdo->lastInsertId();
    }
    
    // Function to insert choice
    function insertChoice($pdo, $dialogue_id, $choice_text, $affinity_change, $leads_to_dialogue_id = null) {
        $stmt = $pdo->prepare("INSERT INTO story_choices (dialogue_id, choice_text, affinity_change, leads_to_dialogue_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$dialogue_id, $choice_text, json_encode($affinity_change), $leads_to_dialogue_id]);
    }
    
    // CHAPTER 1: BAŞLANGIÇ
    echo "Inserting Chapter 1...\n";
    
    $d1_1 = insertDialogue($pdo, 1, 'Leo', 'Hoş geldin. Ben Leo, bu grubun stratejistiyim.', 1, true);
    
    // Leo's response options
    $d1_2a = insertDialogue($pdo, 1, 'Leo', 'Kibarlığın için teşekkürler. Umarım burada kendini rahat hissedersin.', 2, false);
    $d1_2b = insertDialogue($pdo, 1, 'Leo', 'Neural Network HQ, en son teknolojilerle donatılmış. Chloe\'nun eseri.', 2, false);
    $d1_2c = insertDialogue($pdo, 1, 'Leo', 'Oldukça karmaşık. Zamanla öğreneceksin.', 2, false);
    
    // Transition dialogue to Chloe
    $d1_3_transition = insertDialogue($pdo, 1, 'Leo', 'Tanıştığımıza memnun oldum. Arkadaşlarımızı da tanımak isteyeceğini sanıyorum.', 3, false);
    
    // Chloe's introduction
    $d1_4 = insertDialogue($pdo, 1, 'Chloe', 'Heyy! Yeni üye! 🎉 Ben Chloe, buranın tech uzmanıyım!', 4, true);
    
    // Chloe's response options
    $d1_5a = insertDialogue($pdo, 1, 'Chloe', 'Hehe, enerji benim orta adım! Leo biraz ciddi ama iyi adam.', 5, false);
    $d1_5b = insertDialogue($pdo, 1, 'Chloe', 'Teknoloji konusunda ne yapıyorsun?', 5, false);
    $d1_5c = insertDialogue($pdo, 1, 'Chloe', 'Burası gerçekten harika.', 5, false);
    
    // Leo's reaction to Chloe
    $d1_6 = insertDialogue($pdo, 1, 'Leo', 'Chloe... 😑', 6, false);
    
    // Chloe's playful response
    $d1_7 = insertDialogue($pdo, 1, 'Chloe', 'Ne var ki doğru söylüyorum! 😄', 7, true);
    
    // Final responses
    $d1_8a = insertDialogue($pdo, 1, 'Leo', 'Yarın gerçek işe başlayacağız. Dinlen.', 8, false);
    $d1_8b = insertDialogue($pdo, 1, 'Leo', 'Memnun oldum. Yarın görüşürüz.', 8, false);
    $d1_8c = insertDialogue($pdo, 1, 'Leo', 'İyi düşünmüşsün. Dinlenmen önemli.', 8, false);
    
    // Chloe's final line
    $d1_9 = insertDialogue($pdo, 1, 'Chloe', 'Evet! Felix ve Elara\'yı da tanıyacaksın! Çok eğlenceli olacak! ✨', 9, false);
    
    // Choices for Chapter 1
    // Leo's initial choices
    insertChoice($pdo, $d1_1, 'Merhaba Leo, tanıştığımıza memnun oldum.', ['leo' => 3], $d1_2a);
    insertChoice($pdo, $d1_1, 'Bu yer çok etkileyici!', ['leo' => 1], $d1_2b);
    insertChoice($pdo, $d1_1, 'Burası ne tür bir organizasyon?', ['leo' => 2], $d1_2c);
    
    // Link Leo's responses to the transition dialogue
    insertChoice($pdo, $d1_2a, 'Continue', [], $d1_3_transition);
    insertChoice($pdo, $d1_2b, 'Continue', [], $d1_3_transition);
    insertChoice($pdo, $d1_2c, 'Continue', [], $d1_3_transition);
    
    // Link transition to Chloe's introduction
    insertChoice($pdo, $d1_3_transition, 'Continue', [], $d1_4);
    
    // Chloe's choices
    insertChoice($pdo, $d1_4, 'Merhaba Chloe! Çok enerjiksin.', ['chloe' => 3], $d1_5a);
    insertChoice($pdo, $d1_4, 'Teknoloji konusunda ne yapıyorsun?', ['chloe' => 2], $d1_5b);
    insertChoice($pdo, $d1_4, 'Burası gerçekten harika.', ['chloe' => 1], $d1_5c);
    
    // Link Chloe's responses to Leo's reaction
    insertChoice($pdo, $d1_5a, 'Continue', [], $d1_6);
    insertChoice($pdo, $d1_5b, 'Continue', [], $d1_6);
    insertChoice($pdo, $d1_5c, 'Continue', [], $d1_6);
    
    // Link Leo's reaction to Chloe's playful response
    insertChoice($pdo, $d1_6, 'Continue', [], $d1_7);
    
    // Final choices
    insertChoice($pdo, $d1_7, 'Siz nasıl bir ekipsiniz?', ['leo' => 2, 'chloe' => 2], $d1_8a);
    insertChoice($pdo, $d1_7, 'Ben de ekibe katılmaktan mutluyum.', ['leo' => 3, 'chloe' => 3], $d1_8b);
    insertChoice($pdo, $d1_7, 'Biraz sessizce gözlem yapacağım.', ['leo' => 1, 'chloe' => 1], $d1_8c);
    
    // Link final responses to Chloe's last line
    insertChoice($pdo, $d1_8a, 'Continue', [], $d1_9);
    insertChoice($pdo, $d1_8b, 'Continue', [], $d1_9);
    insertChoice($pdo, $d1_8c, 'Continue', [], $d1_9);
    
    // End of Chapter 1
    insertChoice($pdo, $d1_9, 'Continue', [], null); // End of chapter
    
    // CHAPTER 2: TANIŞMA
    echo "Inserting Chapter 2...\n";
    
    $d2_1 = insertDialogue($pdo, 2, 'Felix', 'Ah! Sen yeni arkadaş olmalısın! Ben Felix! 🍳', 1, true);
    
    $d2_2a = insertDialogue($pdo, 2, 'Felix', 'Harika! Birlikte yemek yapabiliriz! Tarif alışverişi yaparız! 😍', 2);
    $d2_2b = insertDialogue($pdo, 2, 'Felix', 'Çok pozitif bir yaklaşım.', 2);
    $d2_2c = insertDialogue($pdo, 2, 'Felix', 'Hangi tür yemekler yapıyorsun?', 2);
    
    $d2_3 = insertDialogue($pdo, 2, 'Felix', 'Yemek yapmayı seviyorum, moralimiz bozulunca herkesi mutlu etmeye çalışırım!', 3);
    
    $d2_4 = insertDialogue($pdo, 2, 'Elara', 'Felix, misafirimizi boğma lütfen.', 4);
    
    $d2_5 = insertDialogue($pdo, 2, 'Elara', 'Ben Elara. Buranın... mentörü sayılırım.', 5, true);
    
    $d2_6a = insertDialogue($pdo, 2, 'Elara', 'Herkesin güçlü yanları var. Ben sadece onları doğru yönde kullanmalarına yardım ediyorum.', 6);
    $d2_6b = insertDialogue($pdo, 2, 'Elara', 'Çok sakin ve profesyonel görünüyorsun.', 6);
    $d2_6c = insertDialogue($pdo, 2, 'Elara', 'Herkesi dengeliyor gibisin.', 6);
    
    $d2_7 = insertDialogue($pdo, 2, 'Felix', 'Elara süper akıllı! Onun sayesinde çok şey öğrendim! 🤓', 7);
    
    $d2_8 = insertDialogue($pdo, 2, 'Elara', 'Felix abartıyor.', 8, true);
    
    $d2_9a = insertDialogue($pdo, 2, 'Felix', 'Yaklaşık 2 yıl! Başta Leo ve Chloe sürekli tartışıyordu! 😅', 9);
    $d2_9b = insertDialogue($pdo, 2, 'Felix', 'Herkesin farklı kişiliği var, ilginç.', 9);
    $d2_9c = insertDialogue($pdo, 2, 'Felix', 'Ben de bu grubun parçası olmaktan mutluyum.', 9);
    
    $d2_10 = insertDialogue($pdo, 2, 'Elara', 'Şimdi daha dengeliler. Sen de bu dengeye katkı sağlayabilirsin.', 10);
    
    // Choices for Chapter 2
    insertChoice($pdo, $d2_1, 'Yemek yapmayı ben de severim!', ['felix' => 5], $d2_2a);
    insertChoice($pdo, $d2_1, 'Çok pozitif bir yaklaşım.', ['felix' => 2], $d2_2b);
    insertChoice($pdo, $d2_1, 'Hangi tür yemekler yapıyorsun?', ['felix' => 3], $d2_2c);
    
    insertChoice($pdo, $d2_5, 'Mentor olarak ne tür rehberlik yapıyorsun?', ['elara' => 3], $d2_6a);
    insertChoice($pdo, $d2_5, 'Çok sakin ve profesyonel görünüyorsun.', ['elara' => 2], $d2_6b);
    insertChoice($pdo, $d2_5, 'Herkesi dengeliyor gibisin.', ['elara' => 4], $d2_6c);
    
    insertChoice($pdo, $d2_8, 'Takım olarak ne kadar süredir birliktesiniz?', ['felix' => 2, 'elara' => 2], $d2_9a);
    insertChoice($pdo, $d2_8, 'Herkesin farklı kişiliği var, ilginç.', ['felix' => 3, 'elara' => 3], $d2_9b);
    insertChoice($pdo, $d2_8, 'Ben de bu grubun parçası olmaktan mutluyum.', ['felix' => 4, 'elara' => 4], $d2_9c);
    
    // CHAPTER 3: İLK GÖREV
    echo "Inserting Chapter 3...\n";
    
    $d3_1 = insertDialogue($pdo, 3, 'Leo', 'Tamam millet, ilk görevimiz geldi.', 1, true);
    
    $d3_2a = insertDialogue($pdo, 3, 'Leo', 'Takım halinde çalışacağız. Herkesin rolü var.', 2);
    $d3_2b = insertDialogue($pdo, 3, 'Leo', 'Takım halinde çalışacağız. Herkesin rolü var.', 2);
    $d3_2c = insertDialogue($pdo, 3, 'Leo', 'Takım halinde çalışacağız. Herkesin rolü var.', 2);
    
    $d3_3 = insertDialogue($pdo, 3, 'Chloe', 'Ooo, ne tür görev? Hacking mi? Surveillance mi? 👨‍💻', 3);
    
    $d3_4 = insertDialogue($pdo, 3, 'Leo', 'Bir şirketin veri güvenlik sistemini test edeceğiz. Ethical hacking.', 4);
    
    $d3_5 = insertDialogue($pdo, 3, 'Felix', 'Yani kötü bir şey yapmayacağız değil mi? 😰', 5);
    
    $d3_6 = insertDialogue($pdo, 3, 'Elara', 'Felix, ethical kelimesinin anlamını biliyorsun.', 6, true);
    
    $d3_7a = insertDialogue($pdo, 3, 'Chloe', 'Ben sistem analizi yapacağım! Leo stratejiyi planlıyor!', 7);
    $d3_7b = insertDialogue($pdo, 3, 'Chloe', 'Ben sistem analizi yapacağım! Leo stratejiyi planlıyor!', 7);
    $d3_7c = insertDialogue($pdo, 3, 'Chloe', 'Ben sistem analizi yapacağım! Leo stratejiyi planlıyor!', 7);
    
    $d3_8 = insertDialogue($pdo, 3, 'Felix', 'Ben... eee... moral destek? 😅', 8);
    
    $d3_9 = insertDialogue($pdo, 3, 'Elara', 'Felix lojistik koordinasyonu yapacak. Sen gözlemci olarak başlayabilirsin.', 9, true);
    
    $d3_10a = insertDialogue($pdo, 3, 'Leo', 'Sabırlı olmak önemli. Aceleye getirmeyelim.', 10);
    $d3_10b = insertDialogue($pdo, 3, 'Leo', 'Sabırlı olmak önemli. Aceleye getirmeyelim.', 10);
    $d3_10c = insertDialogue($pdo, 3, 'Leo', 'Sabırlı olmak önemli. Aceleye getirmeyelim.', 10);
    
    $d3_11 = insertDialogue($pdo, 3, 'Chloe', 'Ama heyecan da önemli! Takım ruhunu yüksek tutmalıyız! ⚡', 11);
    
    $d3_12 = insertDialogue($pdo, 3, 'Felix', 'Ben pasta yaparım! Enerjimiz yüksek olur! 🍰', 12);
    
    $d3_13 = insertDialogue($pdo, 3, 'Elara', 'Felix\'in pastaları gerçekten moralimizi yükseltiyor.', 13, true);
    
    $d3_14a = insertDialogue($pdo, 3, 'Leo', 'Yarın sabah başlıyoruz. Herkese rol dağılımını göndereceğim.', 14);
    $d3_14b = insertDialogue($pdo, 3, 'Leo', 'Yarın sabah başlıyoruz. Herkese rol dağılımını göndereceğim.', 14);
    $d3_14c = insertDialogue($pdo, 3, 'Leo', 'Yarın sabah başlıyoruz. Herkese rol dağılımını göndereceğim.', 14);
    
    $d3_15 = insertDialogue($pdo, 3, 'Chloe', 'Geç saate kadar sistem araştırması yapacağım! 🌙', 15);
    
    $d3_16 = insertDialogue($pdo, 3, 'Felix', 'Ben de erkenden kalkıp kahvaltı hazırlarım! ☕', 16);
    
    $d3_17 = insertDialogue($pdo, 3, 'Elara', 'İyi dinlenin. Yarın odaklanmamız gerekecek.', 17);
    
    // Choices for Chapter 3
    insertChoice($pdo, $d3_1, 'Ben hangi konuda yardımcı olabilirim?', ['leo' => 2, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d3_2a);
    insertChoice($pdo, $d3_1, 'Bu tür görevlerde tecrübem yok.', ['leo' => 1, 'chloe' => 1, 'felix' => 1, 'elara' => 1], $d3_2b);
    insertChoice($pdo, $d3_1, 'Heyecan verici görünüyor!', ['chloe' => 3, 'leo' => 1, 'felix' => 1, 'elara' => 1], $d3_2c);
    
    insertChoice($pdo, $d3_6, 'Gözlemci olarak ne yapmam gerek?', ['elara' => 2, 'leo' => 1], $d3_7a);
    insertChoice($pdo, $d3_6, 'Aktif rol almak istiyorum.', ['leo' => 3, 'chloe' => 2], $d3_7b);
    insertChoice($pdo, $d3_6, 'Herkesin işini öğrenip yardım edebilirim.', ['leo' => 2, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d3_7c);
    
    insertChoice($pdo, $d3_9, 'Ne zaman başlıyoruz?', ['leo' => 2, 'chloe' => 1], $d3_10a);
    insertChoice($pdo, $d3_9, 'Takım halinde çalışmayı dört gözle bekliyorum.', ['leo' => 3, 'chloe' => 3, 'felix' => 3, 'elara' => 3], $d3_10b);
    insertChoice($pdo, $d3_9, 'Başarılı olmak için elimden geleni yapacağım.', ['leo' => 2, 'elara' => 2], $d3_10c);
    
    insertChoice($pdo, $d3_13, 'Ne zaman başlıyoruz?', ['leo' => 2, 'chloe' => 1], $d3_14a);
    insertChoice($pdo, $d3_13, 'Takım halinde çalışmayı dört gözle bekliyorum.', ['leo' => 3, 'chloe' => 3, 'felix' => 3, 'elara' => 3], $d3_14b);
    insertChoice($pdo, $d3_13, 'Başarılı olmak için elimden geleni yapacağım.', ['leo' => 2, 'elara' => 2], $d3_14c);
    
    // CHAPTER 4: GİZEM
    echo "Inserting Chapter 4...\n";
    
    $d4_1 = insertDialogue($pdo, 4, 'Chloe', 'Hâlâ uyanık mısın? Lab\'da garip bir şey keşfettim... 🕵️', 1, true);
    
    $d4_2a = insertDialogue($pdo, 4, 'Leo', 'Dikkatli olmamız gerekiyor. Bu beklemediğimiz bir durum.', 2);
    $d4_2b = insertDialogue($pdo, 4, 'Leo', 'Dikkatli olmamız gerekiyor. Bu beklemediğimiz bir durum.', 2);
    $d4_2c = insertDialogue($pdo, 4, 'Leo', 'Dikkatli olmamız gerekiyor. Bu beklemediğimiz bir durum.', 2);
    
    $d4_3 = insertDialogue($pdo, 4, 'Leo', 'Ben de uyuyamıyordum. Ne buldun?', 3);
    
    $d4_4 = insertDialogue($pdo, 4, 'Chloe', 'Hedef şirketin sisteminde beklenmedik bir şey var. Sanki... birileri bizden önce girmiş.', 4);
    
    $d4_5 = insertDialogue($pdo, 4, 'Chloe', 'İzler çok profesyonel. Kim olursa olsun, çok yetenekli biri.', 5);
    
    $d4_6 = insertDialogue($pdo, 4, 'Leo', 'Yarın Elara\'yla konuşmalıyız. Onun görüşü önemli.', 6, true);
    
    $d4_7a = insertDialogue($pdo, 4, 'Chloe', 'Hayır! Bu daha da ilginç hale getiriyor! 😤', 7);
    $d4_7b = insertDialogue($pdo, 4, 'Chloe', 'Aynen! Gizemi çözmeliyiz! 🔍', 7);
    
    $d4_8a = insertDialogue($pdo, 4, 'Leo', 'Güvenlik öncelikli, ama... merakımı da uyandırdı.', 8);
    $d4_8b = insertDialogue($pdo, 4, 'Leo', 'Kabul ediyorum, ama çok dikkatli olacağız.', 8);
    
    $d4_9 = insertDialogue($pdo, 4, 'Chloe', 'Leo, sen de meraklısın aslında, sadece belli etmiyorsun! 😏', 9);
    
    $d4_10 = insertDialogue($pdo, 4, 'Leo', 'Chloe... 😑 Ama haklısın.', 10, true);
    
    $d4_11a = insertDialogue($pdo, 4, 'Leo', 'Chloe beni çok iyi okuyor. Bazen rahatsız edici. 😅', 11);
    $d4_11b = insertDialogue($pdo, 4, 'Leo', 'Leo\'nun maceracı bir yönün var demek.', 11);
    $d4_11c = insertDialogue($pdo, 4, 'Leo', 'Chloe seni iyi tanıyor.', 11);
    
    $d4_12 = insertDialogue($pdo, 4, 'Chloe', 'Hehe! Leo\'nun soft side\'ını biliyorum! 💙', 12);
    
    $d4_13 = insertDialogue($pdo, 4, 'Leo', 'Uyku vakti. Yarın kafa karışık olmamalıyız.', 13);
    
    $d4_14 = insertDialogue($pdo, 4, 'Chloe', 'Tamam tamam! Ama çok heyecanlıyım! ✨', 14);
    
    // Choices for Chapter 4
    insertChoice($pdo, $d4_1, 'Bu tehlikeli değil mi?', ['leo' => 2, 'chloe' => 1], $d4_2a);
    insertChoice($pdo, $d4_1, 'Ne tür izler buldun?', ['leo' => 1, 'chloe' => 3], $d4_2b);
    insertChoice($pdo, $d4_1, 'Belki içeriden birinin işi?', ['leo' => 3, 'chloe' => 3], $d4_2c);
    
    insertChoice($pdo, $d4_6, 'Görevi iptal etmeli miyiz?', ['leo' => 3, 'chloe' => -1], $d4_7a);
    insertChoice($pdo, $d4_6, 'Daha derinlemesine araştıralım.', ['chloe' => 4, 'leo' => 1], $d4_7b);
    insertChoice($pdo, $d4_6, 'Takım olarak karar verelim.', ['leo' => 2, 'chloe' => 2], $d4_7b); // Same outcome
    
    insertChoice($pdo, $d4_8a, 'Siz iyi bir takım oluyorsunuz.', ['leo' => 3, 'chloe' => 3], $d4_11a);
    insertChoice($pdo, $d4_8a, 'Leo, sen de maceracı bir yönün var demek.', ['leo' => 4, 'chloe' => 2], $d4_11b);
    insertChoice($pdo, $d4_8a, 'Chloe, sen Leo\'yu iyi tanıyorsun.', ['leo' => 2, 'chloe' => 4], $d4_11c);
    
    insertChoice($pdo, $d4_10, 'Siz iyi bir takım oluyorsunuz.', ['leo' => 3, 'chloe' => 3], $d4_11a);
    insertChoice($pdo, $d4_10, 'Leo, sen de maceracı bir yönün var demek.', ['leo' => 4, 'chloe' => 2], $d4_11b);
    insertChoice($pdo, $d4_10, 'Chloe, sen Leo\'yu iyi tanıyorsun.', ['leo' => 2, 'chloe' => 4], $d4_11c);
    
    // CHAPTER 5: HACKING CHALLENGE
    echo "Inserting Chapter 5...\n";
    
    $d5_1 = insertDialogue($pdo, 5, 'Chloe', 'Psst... hâlâ uyanık mısın? Büyük keşif yaptım! 🎉', 1, true);
    
    $d5_2a = insertDialogue($pdo, 5, 'Chloe', 'İzler... tanıdık geliyor. Sanki bu kodu style\'ını daha önce görmüşüm.', 2);
    $d5_2b = insertDialogue($pdo, 5, 'Chloe', 'Bu saatte çalışman sağlıklı değil.', 2);
    $d5_2c = insertDialogue($pdo, 5, 'Chloe', 'Heyecanlı görünüyorsun!', 2);
    
    $d5_3 = insertDialogue($pdo, 5, 'Chloe', 'O gizemli hacker\'ın izlerini takip ediyorum. Ve... şaşırtıcı bir şey buldum.', 3);
    
    $d5_4 = insertDialogue($pdo, 5, 'Chloe', 'Code style\'lar unique olabilir.', 4, true);
    
    $d5_5a = insertDialogue($pdo, 5, 'Chloe', 'Hayır hayır! Bu çok spesifik. Adeta bir imza gibi.', 5);
    $d5_5b = insertDialogue($pdo, 5, 'Chloe', 'Code style\'lar unique olabilir.', 5);
    $d5_5c = insertDialogue($pdo, 5, 'Chloe', 'Çok fazla kod gördüğün için karıştırıyor olabilir.', 5);
    
    $d5_6 = insertDialogue($pdo, 5, 'Chloe', 'Bir dakika... bu pattern... 😱', 6);
    
    $d5_7 = insertDialogue($pdo, 5, 'Chloe', 'OMG! Bu benim eski üniversite arkadaşım Alex\'in code style\'ı!', 7, true);
    
    $d5_8a = insertDialogue($pdo, 5, 'Chloe', 'Alex... çok yetenekli biriydi. Ama üniversiteden sonra kaybettim izini.', 8);
    $d5_8b = insertDialogue($pdo, 5, 'Chloe', 'Onu arayıp sorabilir misin?', 8);
    $d5_8c = insertDialogue($pdo, 5, 'Chloe', 'Bu tesadüf olamaz.', 8);
    
    $d5_9 = insertDialogue($pdo, 5, 'Chloe', 'Eğer gerçekten oysa... bu çok büyük bir tesadüf!', 9);
    
    $d5_10 = insertDialogue($pdo, 5, 'Chloe', 'Yada... hiç de tesadüf değil! 🕵️‍♀️', 10, true);
    
    $d5_11a = insertDialogue($pdo, 5, 'Chloe', 'Leo\'ya söylemeli miyiz?', 11);
    $d5_11b = insertDialogue($pdo, 5, 'Chloe', 'Önce daha fazla araştıralım.', 11);
    $d5_11c = insertDialogue($pdo, 5, 'Chloe', 'Alex\'le iletişim kurmayı dene.', 11);
    
    $d5_12 = insertDialogue($pdo, 5, 'Chloe', 'Sen de uyuma! Birlikte bu gizemi çözeceğiz! 💪', 12);
    
    // Choices for Chapter 5
    insertChoice($pdo, $d5_1, 'Ne buldun?', ['chloe' => 3], $d5_2a);
    insertChoice($pdo, $d5_1, 'Bu saatte çalışman sağlıklı değil.', ['chloe' => 1], $d5_2b);
    insertChoice($pdo, $d5_1, 'Heyecanlı görünüyorsun!', ['chloe' => 4], $d5_2c);
    
    insertChoice($pdo, $d5_4, 'Belki eski bir tanıdığın?', ['chloe' => 2], $d5_5a);
    insertChoice($pdo, $d5_4, 'Code style\'lar unique olabilir.', ['chloe' => 3], $d5_5b);
    insertChoice($pdo, $d5_4, 'Çok fazla kod gördüğün için karıştırıyor olabilir.', ['chloe' => 1], $d5_5c);
    
    insertChoice($pdo, $d5_7, 'Alex kim?', ['chloe' => 3], $d5_8a);
    insertChoice($pdo, $d5_7, 'Onu arayıp sorabilir misin?', ['chloe' => 2], $d5_8b);
    insertChoice($pdo, $d5_7, 'Bu tesadüf olamaz.', ['chloe' => 4], $d5_8c);
    
    insertChoice($pdo, $d5_10, 'Leo\'ya söylemeli miyiz?', ['chloe' => 2], $d5_11a);
    insertChoice($pdo, $d5_10, 'Önce daha fazla araştıralım.', ['chloe' => 4], $d5_11b);
    insertChoice($pdo, $d5_10, 'Alex\'le iletişim kurmayı dene.', ['chloe' => 3], $d5_11c);
    
    // CHAPTER 6: GRUP YEMEĞİ
    echo "Inserting Chapter 6...\n";
    
    $d6_1 = insertDialogue($pdo, 6, 'Felix', 'Günaydın! Erkenden kalkmışsın! ☀️', 1, true);
    
    $d6_2a = insertDialogue($pdo, 6, 'Felix', 'Tabii ki! Birlikte yapmak daha eğlenceli! 😊', 2);
    $d6_2b = insertDialogue($pdo, 6, 'Felix', 'Çok düşünceli davranıyorsun.', 2);
    $d6_2c = insertDialogue($pdo, 6, 'Felix', 'Pancake tarifi nedir?', 2);
    
    $d6_3 = insertDialogue($pdo, 6, 'Felix', 'Özel pancake\'ler yapıyorum! Chloe geç yattı, enerjiye ihtiyacı olacak! 🥞', 3);
    
    $d6_4 = insertDialogue($pdo, 6, 'Elara', 'Günaydın. Felix yine herkesi düşünüyor.', 4, true);
    
    $d6_5a = insertDialogue($pdo, 6, 'Felix', 'Elara da erken kalkandır! İş disiplini 💼', 5);
    $d6_5b = insertDialogue($pdo, 6, 'Felix', 'Felix\'le yemek yapmaya devam edelim.', 5);
    $d6_5c = insertDialogue($pdo, 6, 'Felix', 'Her ikinizle de vakit geçirmek isterim.', 5);
    
    $d6_6 = insertDialogue($pdo, 6, 'Elara', 'Sabah rutinlerim var. Sen de katıl istersen.', 6);
    
    $d6_7 = insertDialogue($pdo, 6, 'Leo', 'Günaydın. Kahve kokusu sardı her yeri.', 7, true);
    
    $d6_8a = insertDialogue($pdo, 6, 'Elara', 'Nasıl rutinler?', 8);
    $d6_8b = insertDialogue($pdo, 6, 'Elara', 'Felix\'le yemek yapmaya devam edelim.', 8);
    $d6_8c = insertDialogue($pdo, 6, 'Elara', 'Her ikinizle de vakit geçirmek isterim.', 8);
    
    $d6_9 = insertDialogue($pdo, 6, 'Chloe', 'Uyuyakalmışım! Felix\'in pancake\'leri mi? 😍', 9);
    
    $d6_10 = insertDialogue($pdo, 6, 'Felix', 'Evet! Özel tarif! Moralinizi yükseltecek! ✨', 10, true);
    
    $d6_11a = insertDialogue($pdo, 6, 'Felix', 'Felix herkesi çok iyi tanıyor.', 11);
    $d6_11b = insertDialogue($pdo, 6, 'Felix', 'Güzel bir sabah oluyor.', 11);
    $d6_11c = insertDialogue($pdo, 6, 'Felix', 'Takım halinde yemek yemek güzel.', 11);
    
    $d6_12 = insertDialogue($pdo, 6, 'Elara', 'Felix\'in öncelikleri her zaman net.', 12);
    
    $d6_13 = insertDialogue($pdo, 6, 'Chloe', 'Bu arada, gece büyük keşif yaptım! Alex meselesini hatırladınız mı?', 13);
    
    $d6_14 = insertDialogue($pdo, 6, 'Leo', 'Alex mi? Kimmiş bu Alex?', 14);
    
    $d6_15 = insertDialogue($pdo, 6, 'Elara', 'Chloe\'nun üniversite arkadaşı.', 15);
    
    $d6_16 = insertDialogue($pdo, 6, 'Felix', 'Yemek yerken iş konuşmayalım! Mideye zararlı! 😅', 16, true);
    
    $d6_17a = insertDialogue($pdo, 6, 'Felix', 'Yemek bittikten sonra toplantı yaparız! Şimdi pancake\'ler soğuyor! 🥞', 17);
    $d6_17b = insertDialogue($pdo, 6, 'Felix', 'Merak ettim, kısaca anlat Chloe.', 17);
    $d6_17c = insertDialogue($pdo, 6, 'Felix', 'Önemli bir konu mu?', 17);
    
    $d6_18 = insertDialogue($pdo, 6, 'Elara', 'Felix\'in öncelikleri her zaman net.', 18);
    
    // Choices for Chapter 6
    insertChoice($pdo, $d6_1, 'Yardım edebilir miyim?', ['felix' => 5], $d6_2a);
    insertChoice($pdo, $d6_1, 'Çok düşünceli davranıyorsun.', ['felix' => 3], $d6_2b);
    insertChoice($pdo, $d6_1, 'Pancake tarifi nedir?', ['felix' => 4], $d6_2c);
    
    insertChoice($pdo, $d6_4, 'Nasıl rutinler?', ['elara' => 3], $d6_5a);
    insertChoice($pdo, $d6_4, 'Felix\'le yemek yapmaya devam edelim.', ['felix' => 4], $d6_5b);
    insertChoice($pdo, $d6_4, 'Her ikinizle de vakit geçirmek isterim.', ['elara' => 2, 'felix' => 2], $d6_5c);
    
    insertChoice($pdo, $d6_7, 'Felix herkesi çok iyi tanıyor.', ['felix' => 4, 'leo' => 1, 'chloe' => 1, 'elara' => 1], $d6_17a);
    insertChoice($pdo, $d6_7, 'Güzel bir sabah oluyor.', ['felix' => 2, 'leo' => 2, 'chloe' => 2, 'elara' => 2], $d6_17b);
    insertChoice($pdo, $d6_7, 'Takım halinde yemek yemek güzel.', ['felix' => 3, 'leo' => 3, 'chloe' => 3, 'elara' => 3], $d6_17c);
    
    insertChoice($pdo, $d6_10, 'Felix haklı, sonra konuşalım.', ['felix' => 4, 'leo' => 2, 'chloe' => 2, 'elara' => 2], $d6_17a);
    insertChoice($pdo, $d6_10, 'Merak ettim, kısaca anlat Chloe.', ['felix' => 1, 'chloe' => 3], $d6_17b);
    insertChoice($pdo, $d6_10, 'Önemli bir konu mu?', ['leo' => 2, 'elara' => 2], $d6_17c);
    
    // CHAPTER 7: MENTÖRLÜK SEANSI
    echo "Inserting Chapter 7...\n";
    
    $d7_1 = insertDialogue($pdo, 7, 'Elara', 'Otur lütfen. Biraz konuşmak istedim.', 1, true);
    
    $d7_2a = insertDialogue($pdo, 7, 'Elara', 'Çok iyi hissediyorum, herkes çok sıcak.', 2);
    $d7_2b = insertDialogue($pdo, 7, 'Elara', 'Biraz overwhelmed, ama pozitif şekilde.', 2);
    $d7_2c = insertDialogue($pdo, 7, 'Elara', 'Hâlâ öğrenmeye çalışıyorum.', 2);
    
    $d7_3 = insertDialogue($pdo, 7, 'Elara', 'Takıma uyum sağlama konusunda nasıl hissediyorsun?', 3);
    
    $d7_4 = insertDialogue($pdo, 7, 'Elara', 'Herkesin farklı yaklaşımları var. Leo analitik, Chloe sezgisel, Felix empatik.', 4, true);
    
    $d7_5a = insertDialogue($pdo, 7, 'Elara', 'Sanırım Leo gibi analitik yaklaşıyorum.', 5);
    $d7_5b = insertDialogue($pdo, 7, 'Elara', 'Chloe gibi sezgilerime güveniyorum.', 5);
    $d7_5c = insertDialogue($pdo, 7, 'Elara', 'Felix gibi herkesi mutlu etmeye çalışıyorum.', 5);
    $d7_5d = insertDialogue($pdo, 7, 'Elara', 'Senin gibi dengeleyici olmaya çalışıyorum.', 5);
    
    $d7_6 = insertDialogue($pdo, 7, 'Elara', 'İlginç. Bu öz-farkındalık çok değerli.', 6);
    
    $d7_7 = insertDialogue($pdo, 7, 'Elara', 'Takımda herkesin güçlü yönleri var, zayıf yönleri de...', 7, true);
    
    $d7_8a = insertDialogue($pdo, 7, 'Elara', 'Herkesin zayıf yönü nedir sence?', 8);
    $d7_8b = insertDialogue($pdo, 7, 'Elara', 'Ben takıma nasıl katkı sağlayabilirim?', 8);
    $d7_8c = insertDialogue($pdo, 7, 'Elara', 'Zayıf yönleri konuşmak doğru mu?', 8);
    
    $d7_9 = insertDialogue($pdo, 7, 'Elara', 'Leo bazen aşırı temkinli. Chloe impulsive. Felix kendini geri planda tutuyor.', 9);
    
    $d7_10 = insertDialogue($pdo, 7, 'Elara', 'Ben de... bazen aşırı analitik oluyorum.', 10, true);
    
    $d7_11a = insertDialogue($pdo, 7, 'Elara', 'Sen çok dengeli görünüyorsun.', 11);
    $d7_11b = insertDialogue($pdo, 7, 'Elara', 'Herkesin gelişim alanları var demek.', 11);
    $d7_11c = insertDialogue($pdo, 7, 'Elara', 'Zayıf yönler de güçlü yönlere dönüşebilir.', 11);
    
    $d7_12 = insertDialogue($pdo, 7, 'Elara', 'Kesinlikle. Ve sen... gözlemci olmaya ek olarak, dengeleyici rol oynayabilirsin.', 12);
    
    $d7_13 = insertDialogue($pdo, 7, 'Elara', 'Herkesin farklı zamanlarda desteğe ihtiyacı oluyor.', 13);
    
    $d7_14 = insertDialogue($pdo, 7, 'Elara', 'Bu tutum seni takımın vazgeçilmez bir parçası yapacak.', 14, true);
    
    $d7_15a = insertDialogue($pdo, 7, 'Elara', 'Bu sorumluluğu alabilirim.', 15);
    $d7_15b = insertDialogue($pdo, 7, 'Elara', 'Nasıl daha iyi destekleyebilirim?', 15);
    $d7_15c = insertDialogue($pdo, 7, 'Elara', 'Takım için elimden geleni yapmak istiyorum.', 15);
    
    $d7_16 = insertDialogue($pdo, 7, 'Elara', 'İhtiyacın olursa, kapım her zaman açık.', 16);
    
    // Choices for Chapter 7
    insertChoice($pdo, $d7_1, 'Çok iyi hissediyorum, herkes çok sıcak.', ['elara' => 3], $d7_2a);
    insertChoice($pdo, $d7_1, 'Biraz overwhelmed, ama pozitif şekilde.', ['elara' => 4], $d7_2b);
    insertChoice($pdo, $d7_1, 'Hâlâ öğrenmeye çalışıyorum.', ['elara' => 2], $d7_2c);
    
    insertChoice($pdo, $d7_4, 'Sanırım Leo gibi analitik yaklaşıyorum.', ['elara' => 2], $d7_5a);
    insertChoice($pdo, $d7_4, 'Chloe gibi sezgilerime güveniyorum.', ['elara' => 2], $d7_5b);
    insertChoice($pdo, $d7_4, 'Felix gibi herkesi mutlu etmeye çalışıyorum.', ['elara' => 3], $d7_5c);
    insertChoice($pdo, $d7_4, 'Senin gibi dengeleyici olmaya çalışıyorum.', ['elara' => 5], $d7_5d);
    
    insertChoice($pdo, $d7_7, 'Herkesin zayıf yönü nedir sence?', ['elara' => 3], $d7_8a);
    insertChoice($pdo, $d7_7, 'Ben takıma nasıl katkı sağlayabilirim?', ['elara' => 4], $d7_8b);
    insertChoice($pdo, $d7_7, 'Zayıf yönleri konuşmak doğru mu?', ['elara' => 2], $d7_8c);
    
    insertChoice($pdo, $d7_10, 'Sen çok dengeli görünüyorsun.', ['elara' => 2], $d7_11a);
    insertChoice($pdo, $d7_10, 'Herkesin gelişim alanları var demek.', ['elara' => 4], $d7_11b);
    insertChoice($pdo, $d7_10, 'Zayıf yönler de güçlü yönlere dönüşebilir.', ['elara' => 5], $d7_11c);
    
    insertChoice($pdo, $d7_14, 'Bu sorumluluğu alabilirim.', ['elara' => 4], $d7_15a);
    insertChoice($pdo, $d7_14, 'Nasıl daha iyi destekleyebilirim?', ['elara' => 3], $d7_15b);
    insertChoice($pdo, $d7_14, 'Takım için elimden geleni yapmak istiyorum.', ['elara' => 2], $d7_15c);
    
    // CHAPTER 8: KRİZ YÖNETİMİ
    echo "Inserting Chapter 8...\n";
    
    $d8_1 = insertDialogue($pdo, 8, 'Leo', 'Acil durum! Hedef şirket bizim sisteme girdiğimizi fark etmiş!', 1, true);
    
    $d8_2a = insertDialogue($pdo, 8, 'Leo', 'Önce nasıl fark ettiklerini öğrenelim.', 2);
    $d8_2b = insertDialogue($pdo, 8, 'Leo', 'Chloe\'ya suçlama yapmayalım.', 2);
    $d8_2c = insertDialogue($pdo, 8, 'Leo', 'Çözüm odaklı düşünelim.', 2);
    
    $d8_3 = insertDialogue($pdo, 8, 'Chloe', 'Ne?! Nasıl oldu? Ben çok dikkatli davrandım! 😱', 3);
    
    $d8_4 = insertDialogue($pdo, 8, 'Felix', 'Bu... bu kötü bir şey mi? Hapise falan girer miyiz? 😰', 4);
    
    $d8_5 = insertDialogue($pdo, 8, 'Elara', 'Sakin olalım. Durumu değerlendirelim.', 5);
    
    $d8_6 = insertDialogue($pdo, 8, 'Chloe', 'Teşekkürler... 😢 System log\'larını kontrol ettim, bir security breach yok.', 6);
    
    $d8_7 = insertDialogue($pdo, 8, 'Elara', 'O zaman nasıl fark ettiler?', 7);
    
    $d8_8 = insertDialogue($pdo, 8, 'Chloe', 'Bekleyin... Alex! Alex onlara söylemiş olmalı!', 8, true);
    
    $d8_9a = insertDialogue($pdo, 8, 'Chloe', 'Alex kimdi tam olarak?', 9);
    $d8_9b = insertDialogue($pdo, 8, 'Chloe', 'Neden sana ihanet ederdi?', 9);
    $d8_9c = insertDialogue($pdo, 8, 'Chloe', 'Şimdi ne yapacağız?', 9);
    
    $d8_10 = insertDialogue($pdo, 8, 'Chloe', 'Alex... eski en yakın arkadaşımdı. Beraber projeler yapardık.', 10);
    
    $d8_11 = insertDialogue($pdo, 8, 'Chloe', 'Ama son sınıfta bir anlaşmazlığımız oldu. Koptu aramız.', 11);
    
    $d8_12 = insertDialogue($pdo, 8, 'Felix', 'Belki... belki hâlâ arkadaş olmak istiyor? 🤔', 12);
    
    $d8_13 = insertDialogue($pdo, 8, 'Leo', 'Felix, bu çok naif bir yaklaşım.', 13, true);
    
    $d8_14a = insertDialogue($pdo, 8, 'Felix', 'Felix\'in bakış açısı değerli.', 14);
    $d8_14b = insertDialogue($pdo, 8, 'Felix', 'Leo haklı, dikkatli olmalıyız.', 14);
    $d8_14c = insertDialogue($pdo, 8, 'Felix', 'Her iki yaklaşımı da göz önünde bulundurmalıyız.', 14);
    
    $d8_15 = insertDialogue($pdo, 8, 'Elara', 'Stratejik düşünmeliyiz. Birkaç seçeneğimiz var.', 15);
    
    $d8_16 = insertDialogue($pdo, 8, 'Leo', '1. Geri çekilip işi bırakabiliriz.', 16);
    
    $d8_17 = insertDialogue($pdo, 8, 'Chloe', '2. Alex\'le doğrudan konuşabilirim.', 17);
    
    $d8_18 = insertDialogue($pdo, 8, 'Felix', '3. Barış teklifi yapabiliriz!', 18);
    
    $d8_19 = insertDialogue($pdo, 8, 'Elara', '4. Legal yollarla durumu çözebiliriz.', 19);
    
    $d8_20 = insertDialogue($pdo, 8, 'Leo', 'Peki, bu planla devam edelim.', 20);
    
    $d8_21 = insertDialogue($pdo, 8, 'Chloe', 'Takım halinde her şeyi çözebiliriz! 💪', 21);
    
    $d8_22 = insertDialogue($pdo, 8, 'Felix', 'Ben kahve yapayım! Kafamız net olsun! ☕', 22);
    
    $d8_23 = insertDialogue($pdo, 8, 'Elara', 'İyi plan. Koordineli hareket edelim.', 23);
    
    // Choices for Chapter 8
    insertChoice($pdo, $d8_1, 'Önce nasıl fark ettiklerini öğrenelim.', ['leo' => 3, 'elara' => 2], $d8_2a);
    insertChoice($pdo, $d8_1, 'Chloe\'ya suçlama yapmayalım.', ['chloe' => 4, 'felix' => 2], $d8_2b);
    insertChoice($pdo, $d8_1, 'Çözüm odaklı düşünelim.', ['leo' => 2, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d8_2c);
    
    insertChoice($pdo, $d8_8, 'Alex kimdi tam olarak?', ['chloe' => 2, 'leo' => 3], $d8_9a);
    insertChoice($pdo, $d8_8, 'Neden sana ihanet ederdi?', ['chloe' => 4, 'leo' => 1, 'felix' => 1, 'elara' => 1], $d8_9b);
    insertChoice($pdo, $d8_8, 'Şimdi ne yapacağız?', ['leo' => 2, 'elara' => 2], $d8_9c);
    
    insertChoice($pdo, $d8_13, 'Felix\'in bakış açısı değerli.', ['felix' => 5, 'leo' => 2, 'chloe' => 2, 'elara' => 2], $d8_14a);
    insertChoice($pdo, $d8_13, 'Leo haklı, dikkatli olmalıyız.', ['leo' => 3, 'elara' => 2], $d8_14b);
    insertChoice($pdo, $d8_13, 'Her iki yaklaşımı da göz önünde bulundurmalıyız.', ['leo' => 3, 'chloe' => 3, 'felix' => 3, 'elara' => 3], $d8_14c);
    
    // CHAPTER 8 MAJOR DECISION
    $d8_24 = insertDialogue($pdo, 8, 'Leo', 'Şimdi önemli bir karar vermemiz gerekiyor.', 24, true);
    
    $d8_25a = insertDialogue($pdo, 8, 'Leo', 'Geri çekilelim, riski göze alamayız.', 25);
    $d8_25b = insertDialogue($pdo, 8, 'Chloe', 'Chloe, Alex\'le konuş.', 25);
    $d8_25c = insertDialogue($pdo, 8, 'Felix', 'Felix\'in barış planı mantıklı.', 25);
    $d8_25d = insertDialogue($pdo, 8, 'Elara', 'Elara\'nın legal yaklaşımı en sağlam.', 25);
    $d8_25e = insertDialogue($pdo, 8, 'Leo', 'Leo, sen karar ver, sen lidersin.', 25);
    
    // Choices for Chapter 8 Major Decision
    insertChoice($pdo, $d8_24, 'Geri çekilelim, riski göze alamayız.', ['leo' => 2, 'chloe' => -1, 'felix' => 1, 'elara' => 3], $d8_25a);
    insertChoice($pdo, $d8_24, 'Chloe, Alex\'le konuş.', ['chloe' => 5, 'leo' => 1, 'felix' => 2, 'elara' => 1], $d8_25b);
    insertChoice($pdo, $d8_24, 'Felix\'in barış planı mantıklı.', ['felix' => 4, 'leo' => 1, 'chloe' => 2, 'elara' => 1], $d8_25c);
    insertChoice($pdo, $d8_24, 'Elara\'nın legal yaklaşımı en sağlam.', ['elara' => 5, 'leo' => 2, 'chloe' => 1, 'felix' => 2], $d8_25d);
    insertChoice($pdo, $d8_24, 'Leo, sen karar ver, sen lidersin.', ['leo' => 5, 'chloe' => 2, 'felix' => 1, 'elara' => 2], $d8_25e);
    
    // CHAPTER 9: KİŞİSEL ANLAR - LEO ROUTE
    echo "Inserting Chapter 9 (Leo Route)...\n";
    
    $d9_1 = insertDialogue($pdo, 9, 'Leo', 'Biraz konuşabilir miyiz? Başka bir yerde.', 1, true);
    
    $d9_2 = insertDialogue($pdo, 9, 'Leo', 'Bu krizde verdiğin tepki... çok olgundu.', 2);
    
    $d9_3 = insertDialogue($pdo, 9, 'Leo', 'Liderlik... zor bir kavram. Bazen yanlış kararlar verme korkusu yaşıyorum.', 3, true);
    
    $d9_4a = insertDialogue($pdo, 9, 'Leo', 'Takım için doğru olanı yapmaya çalıştım.', 4);
    $d9_4b = insertDialogue($pdo, 9, 'Leo', 'Sen de çok iyi liderlik ettin.', 4);
    $d9_4c = insertDialogue($pdo, 9, 'Leo', 'Hep birlikte başardık.', 4);
    
    $d9_5 = insertDialogue($pdo, 9, 'Leo', 'Ama sen yanımda olunca... daha güvenli hissediyorum.', 5);
    
    $d9_6 = insertDialogue($pdo, 9, 'Leo', 'Bu... beklemiyordum. Genelde insanlar bana mesafeli davranır.', 6, true);
    
    $d9_7a = insertDialogue($pdo, 9, 'Leo', 'Ben de senin yanında güvende hissediyorum.', 7);
    $d9_7b = insertDialogue($pdo, 9, 'Leo', 'Sen harika bir lidersin Leo.', 7);
    $d9_7c = insertDialogue($pdo, 9, 'Leo', 'Birbirimizi destekliyoruz.', 7);
    
    $d9_8 = insertDialogue($pdo, 9, 'Leo', 'Sen farklısın. Gerçekten anlıyorsun.', 8);
    
    // Choices for Chapter 9 (Leo Route)
    insertChoice($pdo, $d9_3, 'Takım için doğru olanı yapmaya çalıştım.', ['leo' => 4], $d9_4a);
    insertChoice($pdo, $d9_3, 'Sen de çok iyi liderlik ettin.', ['leo' => 3], $d9_4b);
    insertChoice($pdo, $d9_3, 'Hep birlikte başardık.', ['leo' => 2], $d9_4c);
    
    insertChoice($pdo, $d9_6, 'Ben de senin yanında güvende hissediyorum.', ['leo' => 5], $d9_7a);
    insertChoice($pdo, $d9_6, 'Sen harika bir lidersin Leo.', ['leo' => 3], $d9_7b);
    insertChoice($pdo, $d9_6, 'Birbirimizi destekliyoruz.', ['leo' => 4], $d9_7c);
    
    // CHAPTER 9: KİŞİSEL ANLAR - CHLOE ROUTE
    // We'll add this as an alternative path in Chapter 9
    echo "Inserting Chapter 9 (Chloe Route)...\n";
    
    $d9c_1 = insertDialogue($pdo, 9, 'Chloe', 'Hey! Hadi biraz konuşalım. Lab\'a gelir misin?', 100, true);
    
    $d9c_2 = insertDialogue($pdo, 9, 'Chloe', 'Bu krizde çok cesur davrandın. Gerçekten etkilendim.', 101);
    
    $d9c_3 = insertDialogue($pdo, 9, 'Chloe', 'Alex konusunda... benimle olduğun için teşekkürler.', 102, true);
    
    $d9c_4a = insertDialogue($pdo, 9, 'Chloe', 'Ben de seninle olduğum için mutluyum.', 103);
    $d9c_4b = insertDialogue($pdo, 9, 'Chloe', 'Her şeyi doğru yapmaya çalıştım.', 103);
    $d9c_4c = insertDialogue($pdo, 9, 'Chloe', 'Senin desteğin olmadan başaramazdım.', 103);
    
    $d9c_5 = insertDialogue($pdo, 9, 'Chloe', 'Biliyor musun... seni tanımadan önce hayatım çok farklıydı.', 104);
    
    $d9c_6 = insertDialogue($pdo, 9, 'Chloe', 'Ama şimdi... her şey daha güzel.', 105, true);
    
    $d9c_7a = insertDialogue($pdo, 9, 'Chloe', 'Ben de seni çok seviyorum Chloe.', 106);
    $d9c_7b = insertDialogue($pdo, 9, 'Chloe', 'Sen çok özel bir insansın.', 106);
    $d9c_7c = insertDialogue($pdo, 9, 'Chloe', 'Seninle olmak harika.', 106);
    
    $d9c_8 = insertDialogue($pdo, 9, 'Chloe', 'Gerçekten mi? ... Bu çok güzel.', 107);
    
    // Choices for Chapter 9 (Chloe Route)
    insertChoice($pdo, $d9c_3, 'Ben de seninle olduğum için mutluyum.', ['chloe' => 5], $d9c_4a);
    insertChoice($pdo, $d9c_3, 'Her şeyi doğru yapmaya çalıştım.', ['chloe' => 3], $d9c_4b);
    insertChoice($pdo, $d9c_3, 'Senin desteğin olmadan başaramazdım.', ['chloe' => 4], $d9c_4c);
    
    insertChoice($pdo, $d9c_6, 'Ben de seni çok seviyorum Chloe.', ['chloe' => 5], $d9c_7a);
    insertChoice($pdo, $d9c_6, 'Sen çok özel bir insansın.', ['chloe' => 3], $d9c_7b);
    insertChoice($pdo, $d9c_6, 'Seninle olmak harika.', ['chloe' => 4], $d9c_7c);
    
    // CHAPTER 9: KİŞİSEL ANLAR - FELIX ROUTE
    echo "Inserting Chapter 9 (Felix Route)...\n";
    
    $d9f_1 = insertDialogue($pdo, 9, 'Felix', 'Yemek yapsak mı? Mutfağa gel bakalım.', 200, true);
    
    $d9f_2 = insertDialogue($pdo, 9, 'Felix', 'Bu krizde çok cesur ve düşünceli davrandın.', 201);
    
    $d9f_3 = insertDialogue($pdo, 9, 'Felix', 'Yemek yaparken düşünüyordum... seni çok seviyorum.', 202, true);
    
    $d9f_4a = insertDialogue($pdo, 9, 'Felix', 'Ben de seni seviyorum Felix.', 203);
    $d9f_4b = insertDialogue($pdo, 9, 'Felix', 'Yemeklerin her zaman beni mutlu eder.', 203);
    $d9f_4c = insertDialogue($pdo, 9, 'Felix', 'Seninle tanışmak çok güzel.', 203);
    
    $d9f_5 = insertDialogue($pdo, 9, 'Felix', 'Gerçekten mi? ... Bu çok güzel.', 204);
    
    $d9f_6 = insertDialogue($pdo, 9, 'Felix', 'Her gün seninle kahvaltı yapmak istiyorum.', 205, true);
    
    $d9f_7a = insertDialogue($pdo, 9, 'Felix', 'Ben de her gün seninle kahvaltı yapmak istiyorum.', 206);
    $d9f_7b = insertDialogue($pdo, 9, 'Felix', 'Yemeklerin en güzel yemekler.', 206);
    $d9f_7c = insertDialogue($pdo, 9, 'Felix', 'Mutfağına davetlisin.', 206);
    
    $d9f_8 = insertDialogue($pdo, 9, 'Felix', 'Gerçekten mi? ... Bu çok güzel.', 207);
    
    // Choices for Chapter 9 (Felix Route)
    insertChoice($pdo, $d9f_3, 'Ben de seni seviyorum Felix.', ['felix' => 5], $d9f_4a);
    insertChoice($pdo, $d9f_3, 'Yemeklerin her zaman beni mutlu eder.', ['felix' => 3], $d9f_4b);
    insertChoice($pdo, $d9f_3, 'Seninle tanışmak çok güzel.', ['felix' => 4], $d9f_4c);
    
    insertChoice($pdo, $d9f_6, 'Ben de her gün seninle kahvaltı yapmak istiyorum.', ['felix' => 5], $d9f_7a);
    insertChoice($pdo, $d9f_6, 'Yemeklerin en güzel yemekler.', ['felix' => 3], $d9f_7b);
    insertChoice($pdo, $d9f_6, 'Mutfağına davetlisin.', ['felix' => 4], $d9f_7c);
    
    // CHAPTER 9: KİŞİSEL ANLAR - ELARA ROUTE
    echo "Inserting Chapter 9 (Elara Route)...\n";
    
    $d9e_1 = insertDialogue($pdo, 9, 'Elara', 'Görüşelim mi? Ofisime uğramak ister misin?', 300, true);
    
    $d9e_2 = insertDialogue($pdo, 9, 'Elara', 'Bu krizde çok olgun davrandın. Gerçekten etkilendim.', 301);
    
    $d9e_3 = insertDialogue($pdo, 9, 'Elara', 'Seni gözlemlemek... beni çok etkiledi.', 302, true);
    
    $d9e_4a = insertDialogue($pdo, 9, 'Elara', 'Ben de seni çok saygı duyuyorum.', 303);
    $d9e_4b = insertDialogue($pdo, 9, 'Elara', 'Her şeyi doğru yapmaya çalıştım.', 303);
    $d9e_4c = insertDialogue($pdo, 9, 'Elara', 'Senin rehberliğin çok değerli.', 303);
    
    $d9e_5 = insertDialogue($pdo, 9, 'Elara', 'Biliyor musun... seni tanımadan önce hayatım çok farklıydı.', 304);
    
    $d9e_6 = insertDialogue($pdo, 9, 'Elara', 'Ama şimdi... her şey daha güzel.', 305, true);
    
    $d9e_7a = insertDialogue($pdo, 9, 'Elara', 'Ben de seni çok seviyorum Elara.', 306);
    $d9e_7b = insertDialogue($pdo, 9, 'Elara', 'Sen çok özel bir insansın.', 306);
    $d9e_7c = insertDialogue($pdo, 9, 'Elara', 'Seninle olmak harika.', 306);
    
    $d9e_8 = insertDialogue($pdo, 9, 'Elara', 'Gerçekten mi? ... Bu çok güzel.', 307);
    
    // Choices for Chapter 9 (Elara Route)
    insertChoice($pdo, $d9e_3, 'Ben de seni çok saygı duyuyorum.', ['elara' => 5], $d9e_4a);
    insertChoice($pdo, $d9e_3, 'Her şeyi doğru yapmaya çalıştım.', ['elara' => 3], $d9e_4b);
    insertChoice($pdo, $d9e_3, 'Senin rehberliğin çok değerli.', ['elara' => 4], $d9e_4c);
    
    insertChoice($pdo, $d9e_6, 'Ben de seni çok seviyorum Elara.', ['elara' => 5], $d9e_7a);
    insertChoice($pdo, $d9e_6, 'Sen çok özel bir insansın.', ['elara' => 3], $d9e_7b);
    insertChoice($pdo, $d9e_6, 'Seninle olmak harika.', ['elara' => 4], $d9e_7c);
    
    // CHAPTER 10: FINAL CONFRONTATION
    echo "Inserting Chapter 10...\n";
    
    $d10_1 = insertDialogue($pdo, 10, 'System', '⚠️ URGENT: Unauthorized access detected. All team members report to Operations Center immediately.', 1, true);
    
    $d10_2 = insertDialogue($pdo, 10, 'Leo', 'Bu Alex\'in işi olmalı. Sonunda yüzleşme zamanı geldi.', 2);
    
    $d10_3 = insertDialogue($pdo, 10, 'Chloe', 'Sistemlerimize tam erişim sağlamış! Çok tehlikeli! 😰', 3);
    
    $d10_4 = insertDialogue($pdo, 10, 'Felix', 'Bu... bu korkutucu. Birbirimize sıkı sıkıya bağlı kalmalıyız! 💪', 4);
    
    $d10_5 = insertDialogue($pdo, 10, 'Elara', 'Sakin olalım. Şimdiye kadar öğrendiklerimizi kullanalım.', 5);
    
    $d10_6 = insertDialogue($pdo, 10, 'Alex', 'Merhaba Neural Network. Uzun zaman oldu.', 6, true); // Video call
    
    $d10_7 = insertDialogue($pdo, 10, 'Chloe', 'Alex... neden? Neden böyle yapıyorsun? 😢', 7);
    
    $d10_8 = insertDialogue($pdo, 10, 'Alex', 'Sebebi basit. Bu organizasyon gerçekte ne olduğunu biliyor musunuz?', 8);
    
    $d10_9 = insertDialogue($pdo, 10, 'Leo', 'Ne demek istiyorsun?', 9);
    
    $d10_10 = insertDialogue($pdo, 10, 'Alex', 'Hafızanızı manipüle ediyorlar. Siz gerçek kimliklerinizi unutmuşsunuz.', 10, true);
    
    $d10_11a = insertDialogue($pdo, 10, 'System', 'Bu imkansız! Biz kimiz o zaman?', 11);
    $d10_11b = insertDialogue($pdo, 10, 'System', 'Kanıtın var mı?', 11);
    $d10_11c = insertDialogue($pdo, 10, 'System', 'Chloe, Alex\'in ne demek istediğini anlıyor musun?', 11);
    $d10_11d = insertDialogue($pdo, 10, 'System', 'Bize yalan söylüyorsun!', 11);
    
    $d10_12 = insertDialogue($pdo, 10, 'System', '⚠️ MEMORY FRAGMENT ACTIVATED ⚠️', 12);
    
    $d10_13 = insertDialogue($pdo, 10, 'Memory Flash', 'Kendi sesinle: \'Bu proje dünyanın en yetenekli hackerlerini bir araya getirecek. Leo\'nun stratejik zekası, Chloe\'nun teknik dehası, Felix\'in empati yeteneği, Elara\'nın liderlik kabiliyeti...\'', 13);
    
    $d10_14 = insertDialogue($pdo, 10, 'Chloe', 'Bu... bu doğru mu? Sen gerçekten...? 😱', 14);
    
    $d10_15 = insertDialogue($pdo, 10, 'Leo', 'Hafızam... parçalar geri geliyor.', 15);
    
    $d10_16 = insertDialogue($pdo, 10, 'Felix', 'O yüzden hep eve dönmüş gibi hissetmiştim! 😯', 16);
    
    $d10_17 = insertDialogue($pdo, 10, 'Elara', 'Memory suppression... profesyonel seviyede yapılmış.', 17);
    
    $d10_18 = insertDialogue($pdo, 10, 'Alex', 'Hafızan bir saldırı sırasında hasar gördü. Takım seni korumak için geçici hafıza blokajı uyguladı.', 18, true);
    
    $d10_19 = insertDialogue($pdo, 10, 'Alex', 'Ama şimdi... organizasyon sizi kullanıyor. Gerçek amaçları farklı.', 19);
    
    $d10_20 = insertDialogue($pdo, 10, 'Leo', 'Alex haklı olabilir. Son görevlerimizdeki tutarsızlıklar...', 20);
    
    $d10_21 = insertDialogue($pdo, 10, 'Chloe', 'Ve o garip encrypted dosyalar! Hep merak etmiştim! 🤔', 21);
    
    $d10_22 = insertDialogue($pdo, 10, 'Alex', 'Karar verdiniz mi? Organizasyonla savaşacak mısınız?', 22, true);
    
    $d10_23a = insertDialogue($pdo, 10, 'System', 'Evet, gerçeği ortaya çıkaracağız!', 23);
    $d10_23b = insertDialogue($pdo, 10, 'System', 'Barışçıl yoldan çözeriz.', 23);
    $d10_23c = insertDialogue($pdo, 10, 'System', 'Takımımı korumak önceliğim.', 23);
    $d10_23d = insertDialogue($pdo, 10, 'System', 'Organizasyonla doğrudan konuşmalıyız.', 23);
    
    $d10_24 = insertDialogue($pdo, 10, 'System', 'SECURITY BREACH CONTAINED. MEMORY RESTORATION COMPLETE.', 24);
    
    $d10_25 = insertDialogue($pdo, 10, 'Mysterious Voice', 'Well done. The test is complete.', 25);
    
    $d10_26 = insertDialogue($pdo, 10, 'Leo', 'Test? Ne testi?', 26);
    
    $d10_27 = insertDialogue($pdo, 10, 'Voice', 'Memory suppression was part of your training. You needed to rediscover who you truly are.', 27);
    
    $d10_28 = insertDialogue($pdo, 10, 'Chloe', 'Wait, so Alex was working WITH the organization? 😲', 28);
    
    $d10_29 = insertDialogue($pdo, 10, 'Alex', 'Sorry for the deception. But you needed to choose your path freely.', 29, true);
    
    $d10_30 = insertDialogue($pdo, 10, 'Alex', 'Alex, seni çok özledim.', 30);
    
    $d10_31 = insertDialogue($pdo, 10, 'Felix', 'So... we\'re all okay? No one\'s in trouble? 😅', 31);
    
    $d10_32 = insertDialogue($pdo, 10, 'Elara', 'It seems we\'ve all grown stronger through this experience.', 32);
    
    $d10_33 = insertDialogue($pdo, 10, 'Leo', 'Our bond is stronger than any memory manipulation.', 33);
    
    $d10_34 = insertDialogue($pdo, 10, 'Chloe', 'We\'re like a real family now! 👨‍👩‍👧‍👦', 34);
    
    $d10_35 = insertDialogue($pdo, 10, 'Felix', 'Group hug! This calls for a celebration dinner! 🎉', 35);
    
    $d10_36 = insertDialogue($pdo, 10, 'Elara', 'The future looks bright with this team.', 36);
    
    // Choices for Chapter 10
    insertChoice($pdo, $d10_1, 'Herkesi sakinleştirip plan yapalım.', ['leo' => 3, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d10_11a);
    insertChoice($pdo, $d10_1, 'Chloe, sistemleri güvence altına al!', ['chloe' => 4, 'leo' => 2, 'felix' => 1, 'elara' => 2], $d10_11b);
    insertChoice($pdo, $d10_1, 'Leo, sen komuta et, seni destekleyeceğim.', ['leo' => 5, 'chloe' => 1, 'felix' => 1, 'elara' => 1], $d10_11c);
    insertChoice($pdo, $d10_1, 'Birlikte hareket edersek başarırız!', ['leo' => 4, 'chloe' => 4, 'felix' => 4, 'elara' => 4], $d10_11d);
    
    insertChoice($pdo, $d10_10, 'Bu imkansız! Biz kimiz o zaman?', ['leo' => 2, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d10_11a);
    insertChoice($pdo, $d10_10, 'Kanıtın var mı?', ['leo' => 3, 'elara' => 2], $d10_11b);
    insertChoice($pdo, $d10_10, 'Chloe, Alex\'in ne demek istediğini anlıyor musun?', ['chloe' => 4], $d10_11c);
    insertChoice($pdo, $d10_10, 'Bize yalan söylüyorsun!', ['leo' => 1, 'chloe' => 1, 'felix' => 1, 'elara' => 1], $d10_11d);
    
    insertChoice($pdo, $d10_18, 'Evet, gerçeği ortaya çıkaracağız!', ['leo' => 5, 'chloe' => 5, 'felix' => 5, 'elara' => 5], $d10_23a);
    insertChoice($pdo, $d10_18, 'Barışçıl yoldan çözeriz.', ['leo' => 3, 'chloe' => 3, 'felix' => 3, 'elara' => 3], $d10_23b);
    insertChoice($pdo, $d10_18, 'Takımımı korumak önceliğim.', ['leo' => 4, 'chloe' => 4, 'felix' => 4, 'elara' => 4], $d10_23c);
    insertChoice($pdo, $d10_18, 'Organizasyonla doğrudan konuşmalıyız.', ['leo' => 2, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d10_23d);
    
    // Final Group Scene
    $d10_37 = insertDialogue($pdo, 10, 'Leo', 'So, what\'s our next mission?', 37);
    
    $d10_38 = insertDialogue($pdo, 10, 'Chloe', 'Whatever it is, we\'ve got the best team! 🚀', 38);
    
    $d10_39 = insertDialogue($pdo, 10, 'Felix', 'I\'ll make sure everyone stays well-fed and happy! 🍽️', 39);
    
    $d10_40 = insertDialogue($pdo, 10, 'Elara', 'With our combined strengths, anything is possible.', 40);
    
    $d10_41 = insertDialogue($pdo, 10, 'System', 'Neural Network Status: FULLY OPERATIONAL. Team Unity: MAXIMUM. Mission: CONTINUE TOGETHER.', 41, true);
    
    // Final Player Choice
    $d10_42a = insertDialogue($pdo, 10, 'System', 'Let\'s tackle the world together!', 42);
    $d10_42b = insertDialogue($pdo, 10, 'System', 'Our greatest adventure is just beginning.', 42);
    $d10_42c = insertDialogue($pdo, 10, 'System', 'Neural Network forever!', 42);
    $d10_42d = insertDialogue($pdo, 10, 'System', 'Family is everything.', 42);
    
    // Choices for Final Decision
    insertChoice($pdo, $d10_41, 'Let\'s tackle the world together!', ['leo' => 3, 'chloe' => 3, 'felix' => 3, 'elara' => 3], $d10_42a);
    insertChoice($pdo, $d10_41, 'Our greatest adventure is just beginning.', ['leo' => 4, 'chloe' => 4, 'felix' => 4, 'elara' => 4], $d10_42b);
    insertChoice($pdo, $d10_41, 'Neural Network forever!', ['leo' => 2, 'chloe' => 2, 'felix' => 2, 'elara' => 2], $d10_42c);
    insertChoice($pdo, $d10_41, 'Family is everything.', ['leo' => 5, 'chloe' => 5, 'felix' => 5, 'elara' => 5], $d10_42d);
    
    echo "Story mode content populated successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
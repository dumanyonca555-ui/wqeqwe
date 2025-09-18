# 📖 Hikaye Modu Sistemi - Mystic Messenger Tarzı

## Overview
This document describes the implementation of the Story Mode system for the Neural Chat visual novel game. The system provides a chat-based interactive storytelling experience with character affinity mechanics, real-time chapter unlocking, and branching storylines.

## Features Implemented

### 1. Chapter List Screen (story-mode.php)
- Displays all 10 story chapters
- Real-time unlock system (chapters unlock every 3 hours)
- Visual indicators for locked/unlocked/completed chapters
- Countdown timers for upcoming chapters
- Play/Replay functionality

### 2. Chapter Gameplay Screen (chapter-play.php)
- Chat bubble interface with character avatars
- Interactive choice system (2-3 options per dialogue)
- Affinity change notifications
- Typing simulation animations
- Responsive design for mobile devices

### 3. Database Structure
- `story_chapters` - Chapter information and unlock times
- `story_dialogues` - Dialogue content and sequence
- `story_choices` - Player choices and consequences
- `user_story_progress` - User progress tracking

### 4. API Endpoints
- `api/story-dialogue.php` - Process player choices
- `api/story-progress.php` - Save/load user progress
- `api/test_story.php` - Test database connectivity

## Technical Implementation

### Real-time Unlock System
Chapters unlock every 3 hours starting from 15:30:
- Chapter 1: 15:30 (always unlocked)
- Chapter 2: 18:30
- Chapter 3: 21:30
- Chapter 4: 00:30 (next day)
- And so on...

### Affinity System
Player choices affect character affinity scores:
- Positive choices: +1 to +5 points
- Negative choices: -1 to -5 points
- Affinity changes are persistent and affect future interactions

### Branching Storyline
Choices lead to different dialogue paths:
- Each choice connects to a specific next dialogue
- Story branches based on player decisions
- Multiple possible endings based on affinity levels

## File Structure
```
frontend/
├── story-mode.php          # Chapter list screen
├── chapter-play.php        # Chapter gameplay screen
└── assets/
    └── js/
        └── menu-manager.js # Updated with story mode functions

backend/
├── api/
│   ├── story-dialogue.php  # Dialogue processing
│   ├── story-progress.php  # Progress tracking
│   └── test_story.php      # Database testing
├── database/
│   ├── chat_stories_system.sql  # Main schema
│   └── setup_story_mode.sql     # Story mode tables
└── config/
    └── database.php        # Database connection

## Usage Instructions

1. Access the main menu
2. Click on "Chat & Hikayeler" → "Hikaye Modu"
3. Select an unlocked chapter to play
4. Make choices to progress through the story
5. View affinity changes in real-time
6. Complete chapters to unlock the next one

## Future Enhancements

1. **Full Dialogue Content**
   - Add complete dialogue content for all 10 chapters
   - Implement character-specific storylines
   - Add voice acting support

2. **Enhanced Branching**
   - Implement complex branching storylines
   - Add multiple ending paths
   - Include conditional dialogue based on affinity

3. **Improved UI/UX**
   - Add background images for scenes
   - Implement character expressions
   - Add sound effects and background music

4. **Progress Tracking**
   - Implement save/load functionality
   - Add chapter statistics
   - Include achievement system

## Technical Requirements

- PHP 8.x
- MySQL/MariaDB
- Modern web browser
- Mobile-first responsive design
- AJAX-based navigation
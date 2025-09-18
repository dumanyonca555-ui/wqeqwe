#!/bin/bash

# Database setup script for Oyunum/Celestial Tale
echo "Setting up database for Celestial Tale..."

# Create database if it doesn't exist
mysql -u root -e "CREATE DATABASE IF NOT EXISTS celestial_tale CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Check if database creation was successful
if [ $? -eq 0 ]; then
    echo "Database 'celestial_tale' created or already exists."
    
    # Import the main database schema
    echo "Importing database schema..."
    mysql -u root celestial_tale < backend/database/chat_stories_system.sql
    
    if [ $? -eq 0 ]; then
        echo "Database schema imported successfully."
        
        # Apply any updates
        echo "Applying database updates..."
        mysql -u root celestial_tale < backend/database/update_character_profiles.sql
        
        if [ $? -eq 0 ]; then
            echo "Database updates applied successfully."
            echo "Database setup complete!"
        else
            echo "Warning: Database updates may have failed."
        fi
    else
        echo "Error: Database schema import failed."
    fi
else
    echo "Error: Could not create database. Please check MySQL connection."
fi
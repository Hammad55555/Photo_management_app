# process_photos.py
import os
from PIL import Image
import mysql.connector
import sys

# Connect to MariaDB
db_connection = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="mangement"
)
db_cursor = db_connection.cursor()

# Function to process and store photo information
def process_photo(file_path):
    try:
        # Open the image file
        with Image.open(file_path) as img:
            # Extract information (customize this part based on your needs)
            width, height = img.size
            format_type = img.format
            # Add more attributes as needed

            # Insert data into the database
            sql = "INSERT INTO photos (file_path, width, height, format_type) VALUES (%s, %s, %s, %s)"
            values = (file_path, width, height, format_type)
            db_cursor.execute(sql, values)
            db_connection.commit()

            print(f"Processed: {file_path}")

    except Exception as e:
        print(f"Error processing {file_path}: {e}")

# Function to recursively search for photos
def search_photos(folder_path):
    for root, dirs, files in os.walk(folder_path):
        for file in files:
            if file.lower().endswith(('.jpg', '.jpeg', '.png', '.gif')):
                file_path = os.path.join(root, file)
                process_photo(file_path)

# Get folder path from command line argument
folder_path = sys.argv[1]

# Call the function to search and process photos
search_photos(folder_path)

# Close the database connection
db_cursor.close()
db_connection.close()

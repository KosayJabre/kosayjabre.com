import os
import requests
import shutil
from bs4 import BeautifulSoup

SOURCE_PATH = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'src')
OUTPUT_PATH = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'output')

def render_and_save_html(url, output_path):
    print("Rendering: ", url)
    response = requests.get(url)
    soup = BeautifulSoup(response.content, 'html.parser')

    # Ensure the directory exists
    os.makedirs(os.path.dirname(output_path), exist_ok=True)

    with open(output_path, 'w') as file:
        file.write(str(soup))

def copy_file(source_path, output_path):
    print("Copying: ", source_path)
    os.makedirs(os.path.dirname(output_path), exist_ok=True)
    shutil.copy2(source_path, output_path)

def main():
    local_server_base_url = 'http://localhost:8000'

    # Iterate over files and render or copy them
    for root, dirs, files in os.walk(SOURCE_PATH):
        for file in files:
            file_path = os.path.join(root, file)
            output_path = file_path.replace(SOURCE_PATH, OUTPUT_PATH)

            if file.endswith('.php'):
                url = local_server_base_url + file_path.replace(SOURCE_PATH, '').replace('\\', '/')
                render_and_save_html(url, output_path.replace('.php', '.html'))
            else:
                # For non-PHP files, copy them as is
                copy_file(file_path, output_path)

if __name__ == "__main__":
    main()

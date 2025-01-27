import os
import requests
import shutil
from bs4 import BeautifulSoup
from PIL import Image


SOURCE_PATH = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'src')
OUTPUT_PATH = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'docs')


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


def compress_image(source_path, output_path, quality=85):
    print("Compressing: ", source_path)
    img = Image.open(source_path)
    # Convert to RGB mode if necessary (needed for PNG/SVG with transparency)
    if img.mode in ('RGBA', 'LA') or (img.mode == 'P' and 'transparency' in img.info):
        background = Image.new('RGB', img.size, (255, 255, 255))
        if img.mode == 'P':
            img = img.convert('RGBA')
        background.paste(img, mask=img.split()[3])  # 3 is the alpha channel
        img = background
    elif img.mode != 'RGB':
        img = img.convert('RGB')
    
    # Ensure output path ends with .jpg
    output_path = os.path.splitext(output_path)[0] + '.jpg'
    os.makedirs(os.path.dirname(output_path), exist_ok=True)
    img.save(output_path, 'JPEG', optimize=True, quality=quality)


def main():
    local_server_base_url = 'http://localhost:8080'

    # Iterate over files and render or copy them
    for root, dirs, files in os.walk(SOURCE_PATH):
        for file in files:
            file_path = os.path.join(root, file)
            output_path = file_path.replace(SOURCE_PATH, OUTPUT_PATH)

            if file.endswith('.php'):
                url = local_server_base_url + file_path.replace(SOURCE_PATH, '').replace('\\', '/')
                render_and_save_html(url, output_path.replace('.php', '.html'))
            elif file.lower().endswith(('.png', '.jpg', '.jpeg')):
                compress_image(file_path, output_path)
            else:
                # For non-PHP files, copy them as is
                copy_file(file_path, output_path)

if __name__ == "__main__":
    main()

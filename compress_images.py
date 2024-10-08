from PIL import Image
import os

def compress_images(input_folder, output_folder, quality=85):
    if not os.path.exists(output_folder):
        os.makedirs(output_folder)

    # Loop through each file in the input folder
    for filename in os.listdir(input_folder):
        if filename.lower().endswith('.png'):
            img_path = os.path.join(input_folder, filename)
            img = Image.open(img_path)

            # Compress and save the image to the output folder
            output_path = os.path.join(output_folder, filename)
            img.save(output_path, optimize=True, quality=quality)

            print(f"Compressed {filename} and saved to {output_path}")


input_folder = "/Users/kosayjabre/kosayjabre.com/src/resources/airplane_api"
output_folder = "/Users/kosayjabre/kosayjabre.com/src/resources/airplane_api_compressed"
compress_images(input_folder, output_folder)

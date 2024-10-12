<x-html-forms :form="$form" class="my-form">
    <label for="participate-NAME" class="hidden">Name</label>
    <input type="text" name="NAME" placeholder="Name" required id="participate-NAME" class="mb-2 w-full p-4" />

    <label for="participate-SURNAME" class="hidden">Surname</label>
    <input type="text" name="SURNAME" placeholder="Surname" required id="participate-SURNAME"
        class="mb-2 w-full p-4" />

    <label for="participate-EMAIL_ADDRESS" class="hidden">Email Address</label>
    <input type="email" name="EMAIL_ADDRESS" placeholder="Email Address" required id="participate-EMAIL_ADDRESS"
        class="mb-2 w-full p-4" />

    <label for="participate-IG_ACCOUNT" class="hidden">IG account</label>
    <input type="text" name="IG_ACCOUNT" placeholder="IG account" id="participate-IG_ACCOUNT"
        class="mb-2 w-full p-4" />

    <label for="participate-MESSAGE" class="hidden">Message</label>
    <textarea name="MESSAGE" placeholder="Message" required id="participate-MESSAGE" rows="5" class="mb-2 w-full p-4"></textarea>

    <label for="participate-DOWNLOAD_LINK" class="mb-0 font-fk font-bold">Download Link</label>
    <p id="download-link-description" class="mt-0 text-sm">Provide a download link for the material you want to send us.
    </p>
    <input type="url" name="DOWNLOAD_LINK" placeholder="https://example.com/myfile.zip" required
        id="participate-DOWNLOAD_LINK" class="mb-2 w-full p-4" aria-describedby="download-link-description">

    <input type="submit" value="Submit"
        class="mx-auto my-10 block !bg-azul px-20 py-4 font-fk text-sm uppercase tracking-widest text-white" />
</x-html-forms>

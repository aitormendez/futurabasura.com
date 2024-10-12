<x-html-forms :form="$form" class="my-form">
    <label for="participate-NAME" class="hidden">Name</label>
    <input type="text" name="NAME" placeholder="Name" required id="participate-NAME" />

    <label for="participate-SURNAME" class="hidden">Surname</label>
    <input type="text" name="SURNAME" placeholder="Surname" required id="participate-SURNAME" />

    <label for="participate-EMAIL_ADDRESS" class="hidden">Email Address</label>
    <input type="email" name="EMAIL_ADDRESS" placeholder="Email Address" required id="participate-EMAIL_ADDRESS" />

    <label for="participate-MESSAGE" class="hidden">Message</label>
    <textarea name="MESSAGE" placeholder="Message" required id="participate-MESSAGE"></textarea>

    <label for="participate-DOWNLOAD_LINK" class="hidden">Download Link</label>
    <input type="url" name="DOWNLOAD_LINK" placeholder="https://example.com/myfile.zip" required
        id="participate-DOWNLOAD_LINK">

    <input type="submit" value="Submit" />
</x-html-forms>

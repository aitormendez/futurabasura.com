<x-html-forms :form="$form" class="my-form">
    <input name="name" type="text" placeholder="Full Name" required>
    <input name="surname" type="text" placeholder="Surame" required>
    <input name="emailAddress" type="email" placeholder="Email Address" required>
    <textarea id="message" name="message" placeholder="message"></textarea>
    <label for="archivo">Upload ZIP file with documentation</label>
    {{-- <input type="file" id="file" name="file" accept=".zip" required> --}}
    <input type="submit" value="Submit" />
</x-html-forms>

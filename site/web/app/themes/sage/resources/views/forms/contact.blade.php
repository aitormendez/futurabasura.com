<x-html-forms :form="$form" class="my-form">
    <div class="not-prose pb-6">
        <input
            class="!border-negro-fb placeholder:text-gris-claro-fb focus:bg-negro-fb block w-full !border-b px-6 py-4 text-3xl focus:text-white"
            type="text" name="NAME" placeholder="First name" required />

        <input
            class="border-negro-fb placeholder:text-gris-claro-fb focus:bg-negro-fb block w-full border-b px-6 py-4 text-3xl focus:text-white"
            type="text" name="LASTNAME" placeholder="Last name" required />

        <input
            class="border-negro-fb placeholder:text-gris-claro-fb focus:bg-negro-fb block w-full border-b px-6 py-4 text-3xl focus:text-white"
            type="email" name="EMAIL" placeholder="Email" required />

        <input
            class="border-negro-fb placeholder:text-gris-claro-fb focus:bg-negro-fb block w-full border-b px-6 py-4 text-3xl focus:text-white"
            type="text" name="SUBJECT" placeholder="Subject" required />

        <textarea rows="5"
            class="placeholder:text-gris-claro-fb focus:bg-negro-fb mb-6 w-full px-6 py-4 text-3xl focus:text-white"
            name="MESSAGE" placeholder="Message" required></textarea>
        <div class="flex w-full justify-center">
            <input class="border-negro-fb hover:bg-allo uppercas block cursor-pointer border px-6 py-4 text-3xl"
                type="submit" value="Send" />
        </div>
    </div>
</x-html-forms>

@if (!post_password_required())
    <section id="comments" class="comments">
        @if ($responses)
            <h2>
                {!! $title !!}
            </h2>

            <ol class="comment-list">
                {!! $responses !!}
            </ol>

            @if ($paginated)
                <nav aria-label="Comment">
                    <ul class="pager">
                        @if ($previous)
                            <li class="previous">
                                {!! $previous !!}
                            </li>
                        @endif

                        @if ($next)
                            <li class="next">
                                {!! $next !!}
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @endif

        @if ($closed)
            <x-alert type="warning">
                {!! __('Comments are closed.', 'sage') !!}
            </x-alert>
        @endif

        @php(comment_form())
    </section>
@endif

<div style="display: flex; align-items: center; gap: 8px; padding: 1rem;">
    <a href="http://" target="_blank"
        style="text-decoration: none; font-family: ArialBlack, sans-serif; color: white">Texto del enlace</a>
    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
        transform="rotate(-45)" style="width: 32px; height: 32px;">
        <path id="arrowPath" d="M5 12H19M19 12L13 6M19 12L13 18" stroke="white" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</div>

<script>
    const arrowPath = document.getElementById("arrowPath");
    let toggle = true;

    function animateArrow() {
        if (toggle) {
            arrowPath.setAttribute("d", "M3 12H21M21 12L15 6M21 12L15 18"); // Flecha más larga
        } else {
            arrowPath.setAttribute("d", "M6 12H18M18 12L13 7M18 12L13 17"); // Flecha más corta
        }
        toggle = !toggle;
    }

    setInterval(animateArrow, 500); // Cambia cada 500ms
</script>

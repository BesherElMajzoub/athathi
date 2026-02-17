{{-- FAQ Accordion Component --}}
{{-- Usage: @include('components.faq-accordion', ['faqs' => $faqs]) --}}
<div class="faq-accordion">
    @foreach ($faqs as $index => $faq)
        <div class="faq-item">
            <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-{{ $index }}"
                id="faq-question-{{ $index }}">
                <span class="faq-q-text">{{ $faq['question'] }}</span>
                <span class="faq-icon" aria-hidden="true">+</span>
            </button>
            <div class="faq-answer" id="faq-answer-{{ $index }}" role="region"
                aria-labelledby="faq-question-{{ $index }}" hidden>
                <p>{{ $faq['answer'] }}</p>
            </div>
        </div>
    @endforeach
</div>

@once
    @push('scripts')
        <script>
            document.querySelectorAll('.faq-question').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var answer = this.nextElementSibling;
                    var isOpen = this.getAttribute('aria-expanded') === 'true';

                    this.setAttribute('aria-expanded', !isOpen);
                    answer.hidden = isOpen;

                    var icon = this.querySelector('.faq-icon');
                    icon.textContent = isOpen ? '+' : '−';

                    this.parentElement.classList.toggle('open', !isOpen);
                });
            });
        </script>
    @endpush
@endonce

{{-- Choosing template engine --}}
@if ($template === 'pug')
    @include('laravel-vue-component-generator::template.pug')
@else
    @include('laravel-vue-component-generator::template.html')
@endif

{{-- Component logic --}}
<script>
  export default {
    name: '{{ $name }}',
  }
</script>
{{-- Choosing CSS Pre-processors --}}
@if (!empty($style) and $style === 'sass' or $style === 'stylus')
@include('laravel-vue-component-generator::style.sass-stylus')
@elseif (!empty($style) and $style === 'less' or $style === 'scss')
@include('laravel-vue-component-generator::style.less-scss')
@else
@include('laravel-vue-component-generator::style.css')
@endif
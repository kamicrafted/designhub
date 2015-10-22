<form action="{{ url('search/results') }}" class="search-form">
    <input type="search" name="q" placeholder="Search" {% if query %}value="{{ query }}{% endif %}">
    <input type="submit" value="Go">
</form>
<form method="post" action="/contacts">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" required>

    <label for="Email">Email</label>
    <input type="email" name="email" required>

    <label for="Contact">Contact</label>
    <input type="text" name="Contact" required>
    
    <label for="Address">Address</label>
    <input type="text" name="address" required>

    <button type="submit">Add Contact</button>
</form>

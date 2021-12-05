  <section class="login">
    <div class="form-card">
      <h2>Se connecter :</h2>
      <?php echo "<form action='index.php?year=$year&login=1' method='POST'>"; ?>
      <label>Mail</label>
      <input type="email" name="email" placeholder="Mail.." />
      <label>Mot de passe</label>
      <input type="password" name="password" placeholder="Mot de passe..">
      <input type="submit" class="submit-btn" value="Connexion">
      </form>
    </div>
  </section>
  </body>

  </html>
<?php foreach ($zbozi as $radek): ?>
    <?php if ($radek['skladem'] > 0): ?>
        <li>
            <?= $radek['nazev'] ?> – <?= $radek['cena'] ?> Kč (skladem: <?= $radek['skladem'] ?>)
            <form method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?= $radek['id'] ?>">
                <select name="mnozstvi">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?> ks</option>
                    <?php endfor; ?>
                </select>
                <button>Koupit</button>
            </form>
        </li>
    <?php endif; ?>
<?php endforeach; ?>

<?php if (count($books) > 0): ?>
    <table>
        <thead>
        <tr>
            <th><?php echo implode('</th><th>', array_keys(current($books))); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): array_map('htmlentities', $book); ?>
            <tr>
                <td><?php echo implode('</td><td>', $book); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
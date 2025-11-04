<?php
function renderStatCard($title, $value, $icon, $description = '')
{
?>
    <div class="rounded-lg border border-border bg-card text-card-foreground shadow-sm hover:shadow-md transition-shadow">
        <div class="flex flex-row items-center justify-between space-y-0 p-6 pb-2">
            <h3 class="text-sm font-medium tracking-tight"><?php echo htmlspecialchars($title); ?></h3>
            <i data-lucide="<?php echo htmlspecialchars($icon); ?>" class="h-5 w-5 text-muted-foreground"></i>
        </div>
        <div class="p-6 pt-0">
            <div class="text-2xl font-bold"><?php echo htmlspecialchars($value); ?></div>
            <?php if ($description): ?>
                <p class="text-xs text-muted-foreground"><?php echo htmlspecialchars($description); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php
}
?>
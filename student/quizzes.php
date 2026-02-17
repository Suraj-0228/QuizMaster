<?php include_once '../controllers/quizzes-process.php'; ?>

<!-- Header Section -->
<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h1 class="display-5 fw-bold text-light mb-2">Available <span class="text-gradient">Quizzes</span></h1>
        <p class="text-muted lead">Choose a topic and challenge yourself today.</p>
    </div>
    <div class="col-md-6">
        <div class="d-flex gap-2">
            <div class="position-relative flex-grow-1">
                <input type="text" id="quizSearch" class="form-control bg-dark-glass border-secondary text-light ps-5 rounded-pill" placeholder="Search for quizzes...">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            </div>
            <select id="categoryFilter" class="px-3 form-select bg-dark-glass border-secondary text-light rounded-pill" style="max-width: 200px;">
                <option value="">All Categories</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo sanitize($category['name']); ?>"><?php echo sanitize($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<!-- Quizzes Grid -->
<div class="row g-4" id="quizGrid">
    <?php if (count($quizzes) > 0): ?>
        <?php foreach($quizzes as $quiz): ?>
            <div class="col-md-6 col-lg-4 quiz-item" data-category="<?php echo sanitize($quiz['category_name']); ?>">
                <div class="card h-100 glass-card border-0 shadow-lg hover-lift">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2 category-badge">
                                <?php echo sanitize($quiz['category_name']); ?>
                            </span>
                            <?php if($quiz['time_limit'] > 0): ?>
                                <small class="text-warning fw-bold"><i class="fas fa-clock me-1"></i> <?php echo $quiz['time_limit']; ?>m</small>
                            <?php else: ?>
                                <small class="text-success fw-bold"><i class="fas fa-infinity me-1"></i> No Limit</small>
                            <?php endif; ?>
                        </div>
                        
                        <h4 class="card-title text-light mb-3"><?php echo sanitize($quiz['title']); ?></h4>
                        <p class="card-text text-muted flex-grow-1 small line-clamp-3 mb-4"><?php echo sanitize($quiz['description']); ?></p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top border-light border-opacity-10">
                            <div class="text-muted small">
                                <i class="fas fa-question-circle me-1"></i> <?php echo $quiz['question_count']; ?> Questions
                            </div>
                            
                            <?php if($quiz['question_count'] > 0): ?>
                                <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>" class="btn btn-sm btn-gradient-primary rounded-pill px-4 shadow-sm">
                                    Start <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            <?php else: ?>
                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>Coming Soon</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="fas fa-box-open fa-4x text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted">No quizzes available yet.</h4>
            <p class="text-muted small">Check back later for new challenges!</p>
        </div>
    <?php endif; ?>
</div>

<script>
const searchInput = document.getElementById('quizSearch');
const categoryFilter = document.getElementById('categoryFilter');
const quizItems = document.querySelectorAll('.quiz-item');

function filterQuizzes() {
    const searchText = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value.toLowerCase();

    quizItems.forEach(item => {
        const title = item.querySelector('.card-title').textContent.toLowerCase();
        const category = item.querySelector('.category-badge').textContent.toLowerCase();
        
        const matchesSearch = title.includes(searchText);
        const matchesCategory = selectedCategory === '' || category.includes(selectedCategory); // strict equality might not work if badge has whitespace, includes is safer or trim()

        if (matchesSearch && matchesCategory) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });

    // Show/Hide "No results" message if needed (optional enhancement)
}

searchInput.addEventListener('keyup', filterQuizzes);
categoryFilter.addEventListener('change', filterQuizzes);
</script>

<?php include_once '../includes/footer.php'; ?>

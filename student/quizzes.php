<?php include_once '../controllers/quizzes-process.php'; ?>

<!-- Header Section -->
<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h1 class="display-5 fw-bold text-light mb-2">Available <span class="text-gradient">Quizzes</span></h1>
        <p class="text-muted lead">Choose a topic and challenge yourself today.</p>
    </div>
    <div class="col-md-6">
        <form action="quizzes.php" method="GET" class="d-flex gap-2" id="filterForm">
            <div class="position-relative flex-grow-1">
                <input type="text" name="search" class="form-control bg-dark-glass border-secondary text-light ps-5 rounded-pill" placeholder="Search for quizzes..." value="<?php echo htmlspecialchars($searchQuery ?? ''); ?>">
                <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
            </div>
            <select name="category" class="px-3 form-select bg-dark-glass border-secondary text-light rounded-pill" style="max-width: 200px;" onchange="document.getElementById('filterForm').submit();">
                <option value="">All Categories</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo sanitize($category['name']); ?>" <?php echo (isset($categoryFilter) && $categoryFilter === $category['name']) ? 'selected' : ''; ?>>
                        <?php echo sanitize($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <!-- Hidden submit button for search input Enter key -->
            <button type="submit" class="d-none">Search</button>
        </form>
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
            <h4 class="text-muted">No quizzes available for this query.</h4>
            <p class="text-muted small">Try adjusting your filters or search terms.</p>
            <a href="quizzes.php" class="btn btn-outline-light mt-3 rounded-pill">Clear Filters</a>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination Controls -->
<?php if (isset($total_pages) && $total_pages > 1): ?>
<div class="row mt-5">
    <div class="col-12 d-flex justify-content-center">
        <nav aria-label="Quiz page navigation">
            <ul class="pagination pagination-lg custom-pagination shadow-lg">
                
                <?php 
                // Build the base query string to preserve search/category filters across pages
                $queryParams = $_GET;
                unset($queryParams['page']); // Remove current page from params
                $queryString = http_build_query($queryParams);
                $queryString = $queryString ? '&' . $queryString : ''; 
                ?>

                <!-- Previous Button -->
                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo $queryString; ?>" tabindex="-1" aria-disabled="<?php echo ($page <= 1) ? 'true' : 'false'; ?>">
                        <i class="fas fa-chevron-left me-1"></i> Prev
                    </a>
                </li>
                
                <!-- Page Numbers -->
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?><?php echo $queryString; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
                
                <!-- Next Button -->
                <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo $queryString; ?>">
                        Next <i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
<?php endif; ?>

<style>
/* Custom Dark Theme Pagination Styles */
.custom-pagination .page-link {
    background-color: rgba(27, 38, 59, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(119, 141, 169, 0.2);
    color: #f1f5f9;
    padding: 0.75rem 1.25rem;
    transition: all 0.3s ease;
}

.custom-pagination .page-item:first-child .page-link {
    border-top-left-radius: 50rem;
    border-bottom-left-radius: 50rem;
    padding-left: 1.5rem;
}

.custom-pagination .page-item:last-child .page-link {
    border-top-right-radius: 50rem;
    border-bottom-right-radius: 50rem;
    padding-right: 1.5rem;
}

.custom-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
    background-color: rgba(119, 141, 169, 0.2);
    border-color: rgba(119, 141, 169, 0.4);
    transform: translateY(-2px);
    z-index: 2;
}

.custom-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #0d6efd 0%, #2563eb 100%);
    border-color: #0d6efd;
    color: white;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
}

.custom-pagination .page-item.disabled .page-link {
    background-color: rgba(15, 23, 42, 0.4);
    color: rgba(241, 245, 249, 0.3);
    border-color: rgba(119, 141, 169, 0.1);
    cursor: not-allowed;
}
</style>

<?php include_once '../includes/footer.php'; ?>

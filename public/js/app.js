// Sidebar toggle for mobile
document.addEventListener("DOMContentLoaded", function () {
  const sidebarTrigger = document.getElementById("sidebar-trigger");
  const sidebar = document.getElementById("sidebar");
  const sidebarOverlay = document.getElementById("sidebar-overlay");

  if (sidebarTrigger && sidebar && sidebarOverlay) {
    // Toggle sidebar
    sidebarTrigger.addEventListener("click", function () {
      sidebar.classList.toggle("-translate-x-full");
      sidebarOverlay.classList.toggle("hidden");
    });

    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener("click", function () {
      sidebar.classList.add("-translate-x-full");
      sidebarOverlay.classList.add("hidden");
    });
  }

  // Initialize Lucide icons
  if (typeof lucide !== "undefined") {
    lucide.createIcons();
  }
});

// Create Task Dialog
function openCreateTaskDialog() {
  showToast("Create task dialog will be implemented with AJAX", "info");
  // This will be implemented with a modal dialog
}

// Handle form submissions
function handleFormSubmit(formId, endpoint, successMessage) {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());

    try {
      const response = await apiCall(endpoint, {
        method: "POST",
        body: JSON.stringify(data),
      });

      if (response.success) {
        showToast(successMessage, "success");
        form.reset();
      } else {
        showToast(response.message || "An error occurred", "error");
      }
    } catch (error) {
      showToast(error.message, "error");
    }
  });
}

// Toast notification system
function showToast(message, type = "info") {
  const container = document.getElementById("toast-container");
  if (!container) return;

  const toast = document.createElement("div");
  toast.className = `flex items-center gap-2 rounded-lg border px-4 py-3 shadow-lg transition-all animate-slide-in ${getToastClasses(
    type
  )}`;

  const icon = getToastIcon(type);
  toast.innerHTML = `
        ${icon}
        <span class="text-sm font-medium">${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto">
            <i data-lucide="x" class="h-4 w-4"></i>
        </button>
    `;

  container.appendChild(toast);
  lucide.createIcons();

  // Auto-remove after 5 seconds
  setTimeout(() => {
    toast.style.opacity = "0";
    setTimeout(() => toast.remove(), 300);
  }, 5000);
}

function getToastClasses(type) {
  const classes = {
    info: "bg-card border-border",
    success: "bg-green-50 border-green-200 text-green-900",
    error: "bg-red-50 border-red-200 text-red-900",
    warning: "bg-yellow-50 border-yellow-200 text-yellow-900",
  };
  return classes[type] || classes.info;
}

function getToastIcon(type) {
  const icons = {
    info: '<i data-lucide="info" class="h-5 w-5"></i>',
    success:
      '<i data-lucide="check-circle" class="h-5 w-5 text-green-600"></i>',
    error: '<i data-lucide="alert-circle" class="h-5 w-5 text-red-600"></i>',
    warning:
      '<i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-600"></i>',
  };
  return icons[type] || icons.info;
}

// Format date
function formatDate(dateString, format = "PPP") {
  const date = new Date(dateString);
  const options = { year: "numeric", month: "long", day: "numeric" };
  return date.toLocaleDateString("en-US", options);
}

// Debounce function
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// API call helper
async function apiCall(url, options = {}) {
  try {
    const response = await fetch(url, {
      ...options,
      headers: {
        "Content-Type": "application/json",
        ...options.headers,
      },
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || "An error occurred");
    }

    return data;
  } catch (error) {
    console.error("API Error:", error);
    throw error;
  }
}

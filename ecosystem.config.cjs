module.exports = {
  apps: [
    {
      name: "laravel-app",
      script: "php",
      args: "artisan serve --host 0.0.0.0 --port 8000",
    },
    {
      name: "vite-dev",
      script: "npm",
      args: "run dev -- --host",
    }
  ]
}

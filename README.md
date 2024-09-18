
# PHP on Vercel - Simple Calculator Example

This repository demonstrates how to host a simple PHP application on Vercel. The project includes a basic calculator that can add, subtract, multiply, and divide two numbers, and it is hosted on Vercel.

## Live Demo

Check out the live demo of this PHP calculator here:

[Demo URL](https://alucard0x1phptest.vercel.app/)

## Getting Started

### Step 1: Clone the repository

Clone this repository to your local machine using the following command:

```bash
git clone https://github.com/Alucard0x1/alucard0x1php.git
```

### Step 2: Install Vercel CLI

If you haven’t already, install the [Vercel CLI](https://vercel.com/docs/cli) by running:

```bash
npm install -g vercel
```

### Step 3: Deploying to Vercel

To deploy the project, navigate to the directory where the repository is cloned and run:

```bash
vercel
```

Vercel will guide you through the deployment process, asking questions such as the project name and domain name. Once deployed, you will have your PHP app live on Vercel!

### Key Files

- **index.php**: Contains the PHP code for the calculator.
- **vercel.json**: Configures routing to ensure that the root URL (/) points to the PHP function in the `/api/index.php` file.

### Vercel Configuration

This project uses Vercel's Serverless Function for PHP. The `vercel.json` file contains the following configuration:

```json
{
  "functions": {
    "app/*.php": {
      "runtime": "vercel-php@0.7.1"
    }
  },
  "rewrites": [
    {
      "source": "/",
      "destination": "/app/index.php"
    }
  ]
}
```

This configuration ensures that requests to the root URL (`/`) are routed to the PHP file in the `api` folder.

### Folder Structure

```
/app/index.php    # The PHP file for the calculator
/vercel.json      # Vercel configuration file
```

### Author
- **Alucard0x1**
- Telegram: [@alucard0x1](https://t.me/alucard0x1)

Enjoy hosting PHP apps on Vercel!

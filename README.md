# UCC (Unahco Central Credit)

UCC is a web application that uses CodeIgniter 4 for the backend API and React with TypeScript and Shadcnui for the frontend. The application is containerized using Docker for easy deployment and management.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features

- Backend API built with CodeIgniter 4
- Frontend developed with React, TypeScript, and Shadcnui
- Dockerized for easy setup and deployment

## Prerequisites

- Docker and Docker Compose installed on your machine

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/cyrusmanatad/ucc-revamp.git
    cd ucc_revamp
    ```

2. Build and start the Docker containers:
    ```sh
    docker-compose up --build
    ```

3. Access the application:
    - The backend API will be available at `http://localhost:8084`
    - The frontend will be available at `http://localhost:3001`

## Usage

- To stop the application, run:
    ```sh
    docker-compose down
    ```

- To rebuild the application after making changes, run:
    ```sh
    docker-compose up --build
    ```

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
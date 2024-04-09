-- Name: Shhejad Vashi
-- ID: 8936136

-- Create Database
 CREATE DATABASE MusicStore;

-- Use Database
USE MusicStore;

-- Create Table: Product
CREATE TABLE Product (
    ProductID INT NOT NULL PRIMARY KEY,
    Name VARCHAR(100),
    Type VARCHAR(50),
    Price DECIMAL(10, 2),
    QuantityAvailable INT,
    ReleaseDate DATE
);

-- Create Table: Artist
CREATE TABLE Artist (
    ArtistID INT NOT NULL PRIMARY KEY,
    Name VARCHAR(100),
    Genre VARCHAR(50)
);

-- Create Table: Genre
CREATE TABLE Genre (
    GenreID INT NOT NULL PRIMARY KEY,
    Name VARCHAR(50)
);

-- Create Table: Supplier
CREATE TABLE Supplier (
    SupplierID INT NOT NULL PRIMARY KEY,
    Name VARCHAR(100),
    ContactInfo VARCHAR(100)
);

-- Create Table: Order
CREATE TABLE Orders (
    OrderID INT NOT NULL PRIMARY KEY,
    SupplierID INT,
    DatePlaced DATE,
    TotalCost DECIMAL(10, 2),
    FOREIGN KEY (SupplierID) REFERENCES Supplier(SupplierID)
);

-- Create Table: Customer
CREATE TABLE Customer (
    CustomerID INT NOT NULL PRIMARY KEY,
    Name VARCHAR(100),
    Email VARCHAR(100),
    Phone VARCHAR(20)
);

-- Create Table: Employee
CREATE TABLE Employee (
    EmployeeID INT NOT NULL PRIMARY KEY,
    Name VARCHAR(100),
    Position VARCHAR(50),
    ContactInfo VARCHAR(100)
);

-- Create Table: Transaction
CREATE TABLE SalesTransaction  (
    TransactionID INT NOT NULL PRIMARY KEY,
    OrderID INT,
    CustomerID INT,
    EmployeeID INT,
    Date DATE,
    TotalAmount DECIMAL(10, 2),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID)
);



#VidhiPatel - 8938596


use musicstore;
-- Query to get all products
SELECT * FROM Product;

-- Query to get orders placed by a specific customer
SELECT * FROM `Orders` WHERE OrderID IN (SELECT OrderID FROM SalesTransaction WHERE CustomerID = 1);

-- Query to get total sales for a specific employee
SELECT EmployeeID, SUM(TotalAmount) AS TotalSales 
FROM SalesTransaction 
WHERE EmployeeID = 1 
GROUP BY EmployeeID;






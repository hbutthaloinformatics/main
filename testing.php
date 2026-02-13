<?php

// Vending Machine System
class VendingMachine {
    private $items = [
        1 => ['name' => 'Soda', 'price' => 2.50, 'qty' => 50],
        2 => ['name' => 'Snacks', 'price' => 1.50, 'qty' => 50],
        3 => ['name' => 'Candy', 'price' => 0.99, 'qty' => 50],
        4 => ['name' => 'Water', 'price' => 1.00, 'qty' => 50],
        5 => ['name' => 'Juice', 'price' => 2.00, 'qty' => 50]
    ];
    
    private $cart = [];
    private $billNumber = 1000;
    
    public function isMachineEmpty() {
        foreach ($this->items as $item) {
            if ($item['qty'] > 0) {
                return false;
            }
        }
        return true;
    }
    
    public function displayItems() {
        echo "\n╔════════════════════════════════════════╗\n";
        echo "║     WELCOME TO VENDING MACHINE          ║\n";
        echo "╚════════════════════════════════════════╝\n\n";
        
        if ($this->isMachineEmpty()) {
            echo "❌ MACHINE IS EMPTY! No items available.\n\n";
            return false;
        }
        
        echo "Available Items:\n";
        echo "─────────────────────────────────────────\n";
        foreach ($this->items as $id => $item) {
            $status = $item['qty'] > 0 ? "✓ IN STOCK" : "✗ OUT OF STOCK";
            printf("%-2d | %-15s | Price: $%-6.2f | Qty: %-3d | %s\n", 
                $id, $item['name'], $item['price'], $item['qty'], $status);
        }
        echo "─────────────────────────────────────────\n\n";
        
        return true;
    }
    
    public function selectItem() {
        echo "Select item number (1-5) or type 'exit': ";
        $choice = trim(fgets(STDIN));
        
        if (strtolower($choice) === 'exit') {
            return null;
        }
        
        if (!is_numeric($choice) || $choice < 1 || $choice > 5) {
            echo "❌ Invalid selection! Please enter 1-5.\n";
            return $this->selectItem();
        }
        
        $choice = (int)$choice;
        
        if ($this->items[$choice]['qty'] <= 0) {
            echo "❌ This item is out of stock!\n";
            return $this->selectItem();
        }
        
        return $choice;
    }
    
    public function selectQuantity($itemId) {
        $maxQty = $this->items[$itemId]['qty'];
        echo "Enter quantity (1-$maxQty): ";
        $qty = trim(fgets(STDIN));
        
        if (!is_numeric($qty) || $qty < 1 || $qty > $maxQty) {
            echo "❌ Invalid quantity! Please enter between 1 and $maxQty.\n";
            return $this->selectQuantity($itemId);
        }
        
        return (int)$qty;
    }
    
    public function addToCart($itemId, $quantity) {
        if (isset($this->cart[$itemId])) {
            $this->cart[$itemId] += $quantity;
        } else {
            $this->cart[$itemId] = $quantity;
        }
        echo "✓ Added " . $quantity . " x " . $this->items[$itemId]['name'] . " to your cart!\n\n";
    }
    
    public function displayCart() {
        if (empty($this->cart)) {
            echo "Your cart is empty!\n";
            return false;
        }
        
        echo "\n╔════════════════════════════════════════════════════════════════╗\n";
        echo "║                      YOUR SHOPPING CART                        ║\n";
        echo "╠════════════════════════════════════════════════════════════════╣\n";
        echo "║ Item          | Unit Price | Qty |  Subtotal                  ║\n";
        echo "║───────────────────────────────────────────────────────────────║\n";
        
        $cartTotal = 0;
        foreach ($this->cart as $itemId => $qty) {
            $subtotal = $this->items[$itemId]['price'] * $qty;
            $cartTotal += $subtotal;
            printf("║ %-13s | $%-9.2f | %3d | $%-27.2f ║\n", 
                $this->items[$itemId]['name'], 
                $this->items[$itemId]['price'], 
                $qty, 
                $subtotal);
        }
        
        echo "╠════════════════════════════════════════════════════════════════╣\n";
        printf("║ Total: $%-57.2f ║\n", $cartTotal);
        echo "╚════════════════════════════════════════════════════════════════╝\n\n";
        
        return $cartTotal;
    }
    
    public function cartMenu() {
        echo "Cart Options:\n";
        echo "1. Continue Shopping\n";
        echo "2. View Cart\n";
        echo "3. Checkout\n";
        echo "4. Clear Cart\n";
        echo "Select option (1-4): ";
        
        $choice = trim(fgets(STDIN));
        return $choice;
    }
    
    public function processPayment() {
        $cartTotal = 0;
        foreach ($this->cart as $itemId => $qty) {
            $cartTotal += $this->items[$itemId]['price'] * $qty;
        }
        
        $paidAmount = 0;
        
        echo "\n╔════════════════════════════════════════╗\n";
        printf("║ Cart Total: $%-29.2f ║\n", $cartTotal);
        echo "╚════════════════════════════════════════╝\n\n";
        
        while ($paidAmount < $cartTotal) {
            $remaining = $cartTotal - $paidAmount;
            printf("Current payment: $%.2f | Remaining: $%.2f\n", $paidAmount, $remaining);
            echo "Enter payment amount (or type 'cancel'): $";
            
            $input = trim(fgets(STDIN));
            
            if (strtolower($input) === 'cancel') {
                echo "❌ Transaction cancelled! Refunding: $" . number_format($paidAmount, 2) . "\n";
                return null;
            }
            
            if (!is_numeric($input) || $input < 0) {
                echo "❌ Invalid amount! Please enter a valid number.\n";
                continue;
            }
            
            $paidAmount += (float)$input;
        }
        
        $change = $paidAmount - $cartTotal;
        
        // Reduce quantities for all items in cart
        foreach ($this->cart as $itemId => $qty) {
            $this->items[$itemId]['qty'] -= $qty;
        }
        
        // Generate bill
        $this->generateBill($cartTotal, $paidAmount, $change);
        
        // Clear cart
        $this->cart = [];
        
        return true;
    }
    
    private function generateBill($cartTotal, $paidAmount, $change) {
        $this->billNumber++;
        $date = date('Y-m-d H:i:s');
        
        echo "\n╔════════════════════════════════════════════════════════════════╗\n";
        echo "║                    TRANSACTION BILL                            ║\n";
        echo "╠════════════════════════════════════════════════════════════════╣\n";
        printf("║ Bill #: %-52d ║\n", $this->billNumber);
        printf("║ Date: %-56s ║\n", $date);
        echo "╠════════════════════════════════════════════════════════════════╣\n";
        echo "║ Items Purchased:                                               ║\n";
        
        foreach ($this->cart as $itemId => $qty) {
            $subtotal = $this->items[$itemId]['price'] * $qty;
            printf("║   %-13s | $%-9.2f x %3d = $%-35.2f ║\n", 
                $this->items[$itemId]['name'], 
                $this->items[$itemId]['price'], 
                $qty, 
                $subtotal);
        }
        
        echo "╠════════════════════════════════════════════════════════════════╣\n";
        printf("║ Cart Total: $%-48.2f ║\n", $cartTotal);
        printf("║ Amount Paid: $%-47.2f ║\n", $paidAmount);
        printf("║ Change: $%-53.2f ║\n", $change);
        echo "╚════════════════════════════════════════════════════════════════╝\n";
        echo "✓ Transaction successful! Thank you!\n\n";
    }
    
    public function run() {
        while (true) {
            if (!$this->displayItems()) {
                echo "System shutting down...\n";
                break;
            }
            
            $itemId = $this->selectItem();
            
            if ($itemId === null) {
                if (!empty($this->cart)) {
                    echo "You have items in your cart!\n";
                    $this->displayCart();
                    echo "Do you want to checkout? (yes/no): ";
                    $confirm = trim(fgets(STDIN));
                    if (strtolower($confirm) === 'yes') {
                        $this->processPayment();
                    }
                }
                echo "Thanks for using the vending machine!\n";
                break;
            }
            
            $quantity = $this->selectQuantity($itemId);
            $this->addToCart($itemId, $quantity);
            
            while (true) {
                $cartChoice = $this->cartMenu();
                
                switch ($cartChoice) {
                    case '1':
                        break 2; // Continue shopping - go back to item selection
                    case '2':
                        $this->displayCart();
                        break;
                    case '3':
                        if (!empty($this->cart)) {
                            $this->processPayment();
                            break 2; // Start fresh after payment
                        } else {
                            echo "❌ Your cart is empty!\n";
                        }
                        break;
                    case '4':
                        $this->cart = [];
                        echo "✓ Cart cleared!\n";
                        break 2; // Go back to item selection
                    default:
                        echo "❌ Invalid option! Please select 1-4.\n";
                }
            }
        }
    }
}

// Start the vending machine
$machine = new VendingMachine();
$machine->run();

?>

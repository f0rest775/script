private function calculateExpenses($expenses,$date,$expense_id) {
        $balances = [];
        
        foreach ($expenses as $payer => $participants) {
        
            $totalPaid = array_sum($participants);
            
            
            $numParticipants = count($participants);
            $splitAmount = $totalPaid / $numParticipants;
    
            foreach ($participants as $receiver => $amount) {
                if (!isset($balances[$payer])) {
                    $balances[$payer] = 0;
                }
                if (!isset($balances[$receiver])) {
                    $balances[$receiver] = 0;
                }
                $balances[$payer] -= $amount;
                $balances[$receiver] += $splitAmount;
            }
        }
        $result = [];
        foreach ($balances as $person => $balance) {
            $result[] = ['expense_id'=>$expense_id,'payer_id' => $person, 'amount' => $balance,'data_expense'=>$date];
        }

        return $result;
        
    }
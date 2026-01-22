<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main side_bar" id="main-menu-navigation" data-menu="menu-navigation">
            
            <li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/Dashboard"><i class="fa fa-home "></i><span class="menu-title" data-i18n="Maintenance">Dashboard</span></a>
			</li>
			
			<!--Manage Members Start Here -->
			<li class=" nav-item"><a href="#"><i class="fa-solid fa-user"></i><span class="menu-title" data-i18n="Forms">Manage Members</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/AddMember" data-i18n="Dual Listbox">Add Member</a>
					</li>
					<!--<li><a class="menu-item" href="<?//= base_url($this->data->controller); ?>/AllMembers" data-i18n="Form Repeater">All Members</a>
					</li>-->
					<!--<li><a class="menu-item" href="<?//= base_url($this->data->controller); ?>/ActiveMembers" data-i18n="Form Wizard">Active Members</a>
					</li>-->
					<li><a class="menu-item" href="<?= base_url($this->data->controller); ?>/ActiveMembers" data-i18n="Form Wizard">All Members</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller); ?>/InactiveMembers" data-i18n="Form Repeater">Retired Members</a>
					</li>
				</ul>
			</li>
			
			<!--Manage Members End Here -->
			
			<!-- Member Details Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/MemberDetails"><i class="fa-solid fa-user-check"></i><span class="menu-title" data-i18n="Maintenance">Member Details</span></a>
			</li>
			<!-- Member Details End Here -->
			
			
			<!-- New Entry Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/NewEntry"><i class="fa-regular fa-folder-open"></i><span class="menu-title" data-i18n="Maintenance">New Entry</span></a>
			</li>
			<!-- New Entry End Here -->
			
			<!-- New Entry Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/HODeduction"><i class="fa-regular fa-folder-open"></i><span class="menu-title" data-i18n="Maintenance">HO  Deduction</span></a>
			</li>
			<!-- New Entry End Here -->
			
			
			<!-- Manage Entries Start Here -->
			<li class=" nav-item"><a href="#"><i class="fa-solid fa-list-check"></i><span class="menu-title" data-i18n="Forms">Manage Entries</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/TodayEntries" data-i18n="Dual Listbox">Today Entries</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/ThisMonthEntries" data-i18n="Form Repeater">This Month Entries</a>
					</li>
                    <li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/AllEntries" data-i18n="Form Wizard">All Entries</a>
					</li>
					
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/CashbookEntries" data-i18n="Dual Listbox">Cashbook Entries</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/B12Entries" data-i18n="Form Repeater">12 B Entries</a>
					</li>
                    <li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/TransferJournalEntries" data-i18n="Form Wizard">Transfer Journal Entries</a>
					</li>
				</ul>
			</li>
			<!-- Manage Entries End Here -->
			
			<!-- Manage Loans Start Here -->
			<!--<li class=" nav-item"><a href="<?//= base_url($this->data->controller);
			?>/DayWiseLoanCronJob"><i class="fa-solid fa-landmark"></i><span class="menu-title" data-i18n="Maintenance">DayWiseLoanCronJob</span></a>
			</li>-->
			<!-- Manage Loans End Here -->
			
			
			<!-- Manage Savings Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/Savings"><i class="fa-sharp fa-solid fa-piggy-bank"></i><span class="menu-title" data-i18n="Maintenance">Savings</span></a>
			</li>
			<!-- Manage Savings End Here -->
			
			<!-- Manage Loans Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/Loan"><i class="fa-solid fa-landmark"></i><span class="menu-title" data-i18n="Maintenance">Loans</span></a>
			</li>
			<!-- Manage Loans End Here -->
			
			
			
			
			<!-- Manage Shares Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/Shares"><i class="fa-solid fa-money-bill-trend-up"></i><span class="menu-title" data-i18n="Maintenance">Shares</span></a>
			</li>
			
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/LoanAccountnew"><i class="fa-solid fa-money-bill-trend-up"></i><span class="menu-title" data-i18n="Maintenance">LOAN ACCOUNT TESTING</span></a>
			</li>
			
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/SavingAccountnew"><i class="fa-solid fa-money-bill-trend-up"></i><span class="menu-title" data-i18n="Maintenance">SAVING ACCOUNT TESTING</span></a>
			</li>
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/ShareAccountnew"><i class="fa-solid fa-money-bill-trend-up"></i><span class="menu-title" data-i18n="Maintenance">SHARE ACCOUNT TESTING</span></a>
			</li>
			
			
			
			<!-- Manage Entries Start Here -->
			
			<!--<li class=" nav-item"><a href="#"><i class="fa-solid fa-list-check"></i><span class="menu-title" data-i18n="Forms">Manage Subsidary</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/LoanAccountSub" data-i18n="Dual Listbox">LOAN ACCOUNT SUBSIDARY</a>
					</li>
					</li>
				</ul>
			</li>-->
			
			<!-- Manage Entries End Here -->
			
			
			<!-- Manage Shares End Here -->
			
			<!-- Manage Report Start Here -->
			<!--<li class=" nav-item"><a href="#"><i class="fa-solid fa-sheet-plastic"></i><span class="menu-title" data-i18n="Maintenance">Report</span></a>
			</li>-->
			<!-- Manage Report End Here -->
			
			<!-- Manage Report Start Here -->
			<!--<li class=" nav-item"><a href="#"><i class="fa-solid fa-download"></i><span class="menu-title" data-i18n="Maintenance">Yearly Report</span></a>
			</li>-->
			<!-- Manage Report End Here -->
			
			<!-- Manage Entries Start Here -->
			<li class=" nav-item"><a href="#"><i class="fa-solid fa-download"></i><span class="menu-title" data-i18n="Forms">Yearly Report</span></a>
                <ul class="menu-content">
					
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/AdvanceDeducted" data-i18n="Form Repeater">ADVANCE TAX DEDUCTED</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/BadDebtsReserve" data-i18n="Form Repeater">BAD DEBTS RESERVE FUND</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/CashInHand" data-i18n="Form Repeater">CASH IN HAND</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/BankChargeAccount" data-i18n="Form Repeater">BANK CHARGE A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/BuildingFundAccount" data-i18n="Form Repeater">BUILDING FUND A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/ConveyanceCharge" data-i18n="Form Repeater">CONVEYANCE CHARGES A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/CreditorsExpenses" data-i18n="Form Repeater">CREDITORS FOR EXPENSES</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/DeadStockAccount" data-i18n="Form Repeater">DEAD STOCK A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/DepriciationCharges" data-i18n="Form Repeater">DEPRICIATION CHARGES</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/DevelopmentFund" data-i18n="Form Repeater">DEVELOPMENT FUND A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SundryDebtors" data-i18n="Form Repeater">SUNDRY DEBTORS (DIVEDEND A/C)</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/DividentOutstanding" data-i18n="Form Repeater">DIVIDEND OUTSTANDING A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/EmployeeSecurity" data-i18n="Form Repeater">EMPLOYEES SECURITY A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/EntertainmentExpenses" data-i18n="Form Repeater">ENTERTAINMENT EXPENSES A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/LoanLedger" data-i18n="Form Repeater">INCOME FROM INTEREST A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SavingsLedger" data-i18n="Form Repeater">INTEREST ON SAVINGS</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/InvestInFdr" data-i18n="Form Repeater">INVESTMENT IN FDR</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/InvestInShares" data-i18n="Form Repeater">INVESTMENT IN SHARES A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/LegalExpensesAccount" data-i18n="Form Repeater">LEGAL EXPENCES</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/LoanAccount" data-i18n="Form Repeater">LOAN ACCOUNT</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/MemberRegistraton" data-i18n="Form Repeater">MEMBER REGISTRATION</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/OtherReserveFund" data-i18n="Form Repeater">OTHER RESERVE FUND A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/HeadOfficeAccount" data-i18n="Form Repeater">P.C.F. HEAD OFFICE A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/PnbcAccount" data-i18n="Form Repeater">PUNJAB NATIONAL BANK C/A</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/PrintingStationary" data-i18n="Form Repeater">PRINTING & STATIONARY A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/ProfitLossApropriation" data-i18n="Form Repeater">PROFIT & LOSS APROPRIATION A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/ReserveFund" data-i18n="Form Repeater">RESERVE FUND A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SalaryAccount" data-i18n="Form Repeater">SALARY ACCOUNT</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SavingAccount" data-i18n="Form Repeater">SAVING ACCOUNT</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/StateBankPatiala" data-i18n="Form Repeater">STATE BANK OF PATIALA C/A</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SecurityFund" data-i18n="Form Repeater">SECURITY FUND A/C</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/ShareAccount" data-i18n="Form Repeater">SHARE ACCOUNT</a>  
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/Miscellaneous" data-i18n="Form Repeater">MISCELLANEOUS EXPENSES</a>  
					</li>
					
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SavingsAcLedger" data-i18n="Form Wizard">SAVING A/C LEDGER</a>
					</li>
                    <li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/LoanAcLedger" data-i18n="Dual Listbox">LOANS A/C LEDGER</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SharesAcLedger" data-i18n="Form Repeater">SHARES A/C LEDGER</a>
					</li>
					<!--<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SharesLedger" data-i18n="Form Repeater">SUBSIDIARY SHARES LEDGER</a>
					</li>-->
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SubsidiaryLoansLedger" data-i18n="Form Repeater">SUBSIDIARY LOANS LEDGER</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SubsidiarySharesLedger" data-i18n="Form Repeater">SUBSIDIARY SHARES LEDGER</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/SubsidiarySavingsLedger" data-i18n="Form Repeater">SUBSIDIARY SAVINGS LEDGER</a>
					</li>
					
					
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/Subsidiaryledgersaving" data-i18n="Form Repeater">SAVING</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller);
					?>/MemberLedger" data-i18n="Form Repeater">MEMBER LEDGER</a>
					</li>					
					<!-- Manage Loans End Here -->
					
				</ul>
			</li>
			<!-- Manage Entries End Here -->
			
			
			
			<!-- Manage Report Start Here -->
			<li class=" nav-item"><a href="<?= base_url($this->data->controller);
			?>/TrialBalance"><i class="fa-solid fa-money-check-dollar"></i><span class="menu-title" data-i18n="Maintenance">Trial Balance</span></a>
			</li>
			<!-- Manage Report End Here -->
			
			
            <li class=" nav-item"><a href="#"><i class="fa fa-edit"></i><span class="menu-title" data-i18n="Forms">Security Settings</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="<?= base_url($this->data->controller); ?>/AccountSettings" data-i18n="Dual Listbox">My Profile</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller); ?>/AccountSettings/UpdateProfile" data-i18n="Form Repeater">Update Profile</a>
					</li>
                    <li><a class="menu-item" href="<?= base_url($this->data->controller); ?>/AccountSettings/ChangePassword" data-i18n="Form Wizard">Change Password</a>
					</li>
					<li><a class="menu-item" href="<?= base_url($this->data->controller); ?>/AccountSettings/Logout" data-i18n="Form Repeater">Logout</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
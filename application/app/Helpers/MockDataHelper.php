<?php

namespace App\Helpers;

class MockDataHelper
{
    public static function getMockCustomers()
    {
        return collect([
            [
                'id' => 1,
                'type' => 'حقوقی',
                'brand_name' => 'شرکت فناوری اطلاعات پارس',
                'company_national_id' => '1012345678',
                'first_name' => null,
                'last_name' => null,
                'national_id' => null,
                'email' => 'info@pars-tech.ir',
                'phone' => '021-88776655',
                'status' => 'تایید شده',
            ],
            [
                'id' => 2,
                'type' => 'حقیقی',
                'brand_name' => null,
                'company_national_id' => null,
                'first_name' => 'علی',
                'last_name' => 'احمدی',
                'national_id' => '0012345678',
                'email' => 'ali.ahmadi@example.com',
                'phone' => '09123456789',
                'status' => 'در انتظار تایید',
            ],
            [
                'id' => 3,
                'type' => 'حقوقی',
                'brand_name' => 'گروه بازرگانی کیمیا',
                'company_national_id' => '2012345678',
                'first_name' => null,
                'last_name' => null,
                'national_id' => null,
                'email' => 'contact@kimia-group.com',
                'phone' => '021-77665544',
                'status' => 'در انتظار تکمیل اطلاعات',
            ],
            [
                'id' => 4,
                'type' => 'حقیقی',
                'brand_name' => null,
                'company_national_id' => null,
                'first_name' => 'مریم',
                'last_name' => 'کریمی',
                'national_id' => '0022345678',
                'email' => 'maryam.karimi@example.com',
                'phone' => '09134567890',
                'status' => 'تایید شده',
            ],
            [
                'id' => 5,
                'type' => 'حقوقی',
                'brand_name' => 'شرکت خدمات دیجیتال نوین',
                'company_national_id' => '3012345678',
                'first_name' => null,
                'last_name' => null,
                'national_id' => null,
                'email' => 'info@novin-digital.ir',
                'phone' => '021-66554433',
                'status' => 'تایید شده',
            ],
            [
                'id' => 6,
                'type' => 'حقیقی',
                'brand_name' => null,
                'company_national_id' => null,
                'first_name' => 'رضا',
                'last_name' => 'محمدی',
                'national_id' => '0032345678',
                'email' => 'reza.mohammadi@example.com',
                'phone' => '09145678901',
                'status' => 'در انتظار تکمیل اطلاعات',
            ],
        ]);
    }

    public static function getCustomerName($customer)
    {
        if ($customer['type'] === 'حقوقی') {
            return $customer['brand_name'];
        } else {
            return $customer['first_name'] . ' ' . $customer['last_name'];
        }
    }

    public static function getCustomerIdentifier($customer)
    {
        if ($customer['type'] === 'حقوقی') {
            return $customer['company_national_id'];
        } else {
            return $customer['national_id'];
        }
    }

    public static function getCampaignTypes()
    {
        return [
            'irancell-man' => 'ایرانسل من',
            'missed-call' => 'تماس از دست رفته',
            'targeted-sms' => 'پیامک هدفمند',
        ];
    }

    public static function getMockCustomerByCampaignId($campaignId)
    {
        $customers = self::getMockCustomers();
        // Map campaign ID to customer (using modulo to cycle through customers)
        $customerIndex = ($campaignId - 1) % $customers->count();
        return $customers->values()->get($customerIndex);
    }

    public static function getCampaignTypeByCampaignId($campaignId)
    {
        $types = self::getCampaignTypes();
        $typeKeys = array_keys($types);
        // Map campaign ID to campaign type (using modulo to cycle through types)
        $typeIndex = ($campaignId - 1) % count($typeKeys);
        return $types[$typeKeys[$typeIndex]];
    }
}


<div>
    @if ($violationsData->isNotEmpty())
        <div class="flex">
            <div class="w-1/2">
                <div class="pie-chart-container">
                    <svg viewBox="0 0 100 100" class="pie-chart">
                        @php
                            $total = $violationsData->sum('total');
                            $startAngle = 0;
                        @endphp

                        @foreach ($violationsData as $violation)
                            @php
                                $percentage = ($violation['total'] / $total) * 100;
                                $endAngle = $startAngle + $percentage;
                                $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                            @endphp

                            <path
                                d="M50 50 L50 0 A50 50 0 {{ $percentage > 50 ? 1 : 0 }} 1 {{ cos(deg2rad($endAngle)) * 50 + 50 }} {{ sin(deg2rad($endAngle)) * 50 + 50 }} Z"
                                fill="{{ $color }}"
                            ></path>

                            @php $startAngle = $endAngle; @endphp
                        @endforeach
                    </svg>
                </div>
            </div>

            <div class="w-1/2">
                <h2>Common Violations</h2>
                <ul>
                    @foreach ($violationsData as $violation)
                        <li>{{ $violation['violation'] }}: {{ $violation['total'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <p>No data available.</p>
    @endif

    <script>
        window.addEventListener('livewire:load', function () {
            Livewire.on('dataLoaded', function (data) {
                // Update the Livewire component with the loaded data
                Livewire.emit('updateChart', data);
            });
        });
    </script>
</div>
